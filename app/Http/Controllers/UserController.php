<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
     public function Showlogin(){
        return view('Auth.login');
    }

    //public function login(Request $request){
      //  $email= $request->email;
       // $pass = $request->password;

      //  if(Auth::attempt(['email'=>$email,'password'=>$pass])){
          //  if(Auth::user()->role == 0){
         //       return redirect('/');
          //  }else{
          //      return redirect('/dashboard');
         //   }
       // }else{
         //   return redirect('/login');
        //}
    //}

    public function ShowRegister(){
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // checks password_confirmation
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully!');
    }
       

    public function renderDashboard(){
        if(Auth::user()->role == 0){
            return redirect('/');
        }
        return view('admin.dashboard');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

         return redirect()->route('user.dashboard');
    }

    return back()->with('error', 'Invalid credentials.');
}


public function dashboard() {
    return view('user.dashboard');
}

}
