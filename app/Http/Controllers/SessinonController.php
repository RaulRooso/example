<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessinonController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        //Validate
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //atempt to login
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.' //<-does not print?
            ]);
        }
        // regenerate session doken
        request()->session()->regenerate();
        // redirect
        return redirect('/jobs');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
