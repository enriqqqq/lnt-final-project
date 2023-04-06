<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminId;
use Illuminate\Validation\Rule;

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
            'password' => ['required', 'between:6, 12'],
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
                return redirect('/admin');
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

    // Show User Data
    public function show(User $user){
        if (auth()->user()->id != $user->id && !auth()->user()->isAdmin()) {
            return redirect('/')->with('message', "An error occured.");
        }

        if(auth()->user()->isAdmin()){
            return view('profile', [
                'admin' => AdminId::where('user_id', $user->id)->first()
            ]);
        }
        return view('profile');
    }

    // Update User
    public function update(Request $request, User $user){
        if($request->has('admin_id')){
            return redirect('/user' . '/update' . '/' . $user->id)->with('message', 'You cannot change Admin ID.');
        }

        if($request->has('email') && $user->role != 'admin'){
            return redirect('/user' . '/update' . '/' . $user->id)->with('message', 'You cannot change your Email.');
        }

        $formFields = $request->validate([
            'name' => ['between:3, 40'],
            'phone_number' => ['regex:/^08[0-9]{0,12}$/', Rule::unique('users')->ignore($user->id)],
        ]);
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images/users', $imageName);
            $formFields['image'] = $imageName;
        }

        $user->update($formFields);
        return redirect('/users' . '/' . $user->id)->with('message', 'You\'ve updated your info');
    }
}