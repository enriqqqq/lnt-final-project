<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show Login Form
    public function login(){
        return view('login');
    }

    // Show Register Form
    public function register(){
        return view('register');
    }

    // Store entry
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'between:3, 40'],
            'email' => ['required', 'regex:/^[a-zA-Z0-9._]+@gmail.com$/', 'unique:users,email'],
            'password' => ['required', 'between:10, 40'],
            'phone_number' => ['required', 'regex:/^08[0-9]{0,12}$/', 'unique:users,phone_number']
        ]);

        $formFields['password'] = bcrypt($request->password);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images/users', $imageName);
            $formFields['image'] = $imageName;
        }

        User::create($formFields);
        return redirect('/')->with('message', 'Nice! You\'re Account is Registered!');
    }

    // Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)){
            $user = User::where('email', $formFields['email'])->first();
            $request->session()->regenerate();

            if($user->isAdmin()){
                return redirect('/');
            } else {
                return redirect('/');
            }
        }
        
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Log User Out
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You logged out');
    }
}
