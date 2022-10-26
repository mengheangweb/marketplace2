<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Validation\Rule;
use Auth;
//use App\Mail\Welcome;
use App\Mail\WelcomeSecond;
use App\Jobs\Welcome;
use Mail;

class AuthController extends Controller
{
    public function notification()
    {
        $notifications = Auth::user()->notifications;

        return view('notification.listing', compact('notifications'));
    }

    public function readNotification($id)
    {
        $notification = Auth::user()->notifications->where('id', $id)->first();

        $notification->markAsRead();

        return redirect()->back();
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

        Auth::login($user);

        // send welcome email

        // Mail::to($user->email)->send(new WelcomeSecond($user));

        Welcome::dispatch($user)->delay(now()->addMinutes(1));


        return redirect()->to('/home')->with('success', 'You have successfully registered.');

    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        $check = Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ]);

        if(! $check){
            return redirect()->back()->with('error', 'Incorrect credential.');
        }

        return redirect()->to('/home')->with('success', 'You have successfully logged in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back()->with('success', 'You have successfully logged out.');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $userId = auth()->user();

        $this->validate($request, [
            'name' => 'required|string|min:2',
            'email' => [
                'required',
                Rule::unique('users')->ignore($userId),
            ],
        ]);

        $user = User::whereId(auth()->user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);


        return redirect()->back()->with('success', 'You have successfully update your profile.');

    }
}
