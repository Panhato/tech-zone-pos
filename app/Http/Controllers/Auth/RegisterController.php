<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // ១. ត្រួតពិនិត្យទិន្នន័យ (Validation)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // ត្រូវមាន input ឈ្មោះ password_confirmation
        ]);

        // ២. បង្កើត User ថ្មីក្នុង Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ៣. ឱ្យ User ចូលប្រើប្រាស់ភ្លាមៗ (Login)
        Auth::login($user);

        // ៤. បញ្ជូនទៅ​ទំព័រ​ទំនិញ​សាធារណៈ
        return redirect()->route('shop.index')->with('success', 'ការចុះឈ្មោះបានជោគជ័យ!');
    }
}