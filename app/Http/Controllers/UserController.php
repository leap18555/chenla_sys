<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * បង្ហាញទំព័រ Login (GET /login)
     */
    public function ShowLogin(): View
    {
        return ViewFacade::first(['auth.login', 'login', 'user.login']);
    }

    /**
     * បង្ហាញទំព័រ Register (GET /register)
     */
    public function ShowRegister(): View
    {
        return ViewFacade::first(['auth.register', 'register', 'user.register']);
    }

    /**
     * ដំណើរការ Login (POST /login ឬ POST /api/login)
     */
    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // ឆែកមើលថាតើជាការហៅតាមរយៈ API ឬទាមទារ JSON
        $isApiRequest = $request->expectsJson() || $request->is('api/*');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            if ($isApiRequest) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'អ៊ីមែល ឬពាក្យសម្ងាត់មិនត្រឹមត្រូវឡើយ។',
                ], 401);
            }

            return back()->withErrors([
                'email' => 'អ៊ីមែល ឬពាក្យសម្ងាត់មិនត្រឹមត្រូវឡើយ។',
            ])->onlyInput('email');
        }

        // បង្កើត Session ថ្មី លុះត្រាតែ Request នោះមាន Session (ការពារ Error លើ routes/api.php)
        if ($request->hasSession()) {
            $request->session()->regenerate();
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isAdmin = method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role == 1);

        $redirectUrl = $isAdmin ? route('user.Home') : route('user.Home');

        // ប្រសិនបើហៅតាម API / Postman / AJAX ឱ្យបោះជា JSON
        if ($isApiRequest) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status'       => 'success',
                'message'      => 'ចូលប្រព័ន្ធជោគជ័យ!',
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'role'         => $isAdmin ? 'admin' : 'user',
                'redirect_to'  => $redirectUrl,
                'user'         => $user,
            ], 200);
        }

        // ប្រសិនបើ Submit តាម Form ធម្មតា ឱ្យ Redirect ទៅកាន់ Dashboard
        return redirect()->intended($redirectUrl);
    }

    /**
     * ដំណើរការ Register (POST /register ឬ POST /api/register)
     */
    public function register(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 0,
        ]);

        $isApiRequest = $request->expectsJson() || $request->is('api/*');

        // ចូលប្រព័ន្ធដោយស្វ័យប្រវត្តិសម្រាប់ Web Session (បើមាន Session)
        if ($request->hasSession()) {
            Auth::login($user);
            $request->session()->regenerate();
        }

        if ($isApiRequest) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status'       => 'success',
                'message'      => 'បង្កើតគណនី និងចូលប្រព័ន្ធជោគជ័យ!',
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'redirect_to'  => route('user.Home'),
                'user'         => $user,
            ], 201);
        }

        return redirect()->route('user.Home');
    }

    /**
     * ដំណើរការ Logout (POST /logout ឬ POST /api/logout)
     */
    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        /** @var \App\Models\User|null $user */
        $user = $request->user();

        if ($user && method_exists($user, 'currentAccessToken')) {
            /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */
            $token = $user->currentAccessToken();

            if ($token && method_exists($token, 'delete')) {
                $token->delete();
            }
        }

        // បិទ Web Session លុះត្រាតែមាន Session នៅលើ Request
        if ($request->hasSession()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'status'  => 'success',
                'message' => 'ចាកចេញពីប្រព័ន្ធជោគជ័យ។',
            ], 200);
        }

        return redirect()->route('login');
    }
}
