<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Verify the email address
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        // Save email to the session to identify the user for resetting the password
        session(['reset_email' => $request->email]);

        return redirect()->route('reset-password')->with('success', 'Email verified! You can now reset your password.');
    }

    // Show the reset password form
    public function showResetPasswordForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('forgot-password')->withErrors(['error' => 'Unauthorized access.']);
        }

        return view('auth.reset-password');
    }

    // Handle password reset
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgot-password')->withErrors(['error' => 'Something went wrong. Please try again.']);
        }

        // Check if the new password is the same as the current password
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The new password cannot be the same as the current password.']);
        }

        // Optionally, check for similarity (e.g., if the new password is too close to the old one)
        similar_text($user->password, $request->password, $similarity);
        if ($similarity > 50) { // Adjust similarity threshold as needed
            return back()->withErrors(['password' => 'The new password is too similar to the current password.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the session data
        session()->forget('reset_email');

        return redirect('/login')->with('success', 'Password updated successfully! You can now log in.');
    }

}

