<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display Login Page
    public function ShowLogin()
    {
        return view('Auth.login');
    }

    // Handle Login Submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // ប្រសិនបើជា Admin ឱ្យរត់ទៅ Dashboard
            if ($user->role === 'admin' || $user->role == 1) {
                return redirect()->route('dashboard');
            }

            // ប្រសិនបើជា User ធម្មតា ឱ្យរត់ទៅ User Home
            return redirect()->route('user.Home');
        }

        return back()->with('error', 'អ៊ីមែល ឬពាក្យសម្ងាត់មិនត្រឹមត្រូវឡើយ។');
    }

    // Display Register Page
    public function ShowRegister()
    {
        return view('Auth.register');
    }

    // Handle Register Submission
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto Login បន្ទាប់ពី Register រួច និងបញ្ជូនទៅ Dashboard ភ្លាមៗ
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'បង្កើតគណនី និងចូលប្រព័ន្ធជោគជ័យ!');
    }

    // Render Dashboard
    public function renderDashboard()
    {
        // ការពារ Error ប្រសិនបើមិនទាន់ Login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 0) {
            return redirect('/');
        }
        
        return view('admin.dashboard');
    }

    public function dashboard()
    {
        return view('user.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}