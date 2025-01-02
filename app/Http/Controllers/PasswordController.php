<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function edit(){
        return view('auth.updatePassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Ensure the user is a valid model instance
        if (!$user || !($user instanceof \App\Models\User)) {
            return back()->withErrors(['error' => 'User is invalid.']);
        }

        // Update the user's password
        try {
            $user->password = Hash::make($request->new_password);
            $user->save(); // Save the updated password
        } catch (\Exception $e) {
            return redirect('/update-password')->with('error', 'Password updated successfully!');
        }


        return redirect('/update-password')->with('success', 'Password updated successfully!');
    }

}
