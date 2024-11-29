<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->redirect();
    }

    public function callbackGoogle()
{
    try {
        // Get user details from Google
        $google_user = Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->user();

        // Check if the user already exists based on google_id or email
        $user = User::where('google_id', $google_user->getId())
                    ->orWhere('email', $google_user->getEmail())
                    ->first();

        // If the user doesn't exist, create a new one
        if (!$user) {
            $user = User::create([
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'id' => $google_user->getId(),
                
                 // Store google_id
                'password' => null // No password needed, leave it as null
            ]);
        }

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard
        return redirect()->intended('dashboard');

    } catch (\Throwable $th) {
        dd('Something went wrong: ' . $th->getMessage());
    }
}



}
