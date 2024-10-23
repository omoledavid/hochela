<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            // Retrieve Google user details
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Split the name into firstname and lastname (assuming Google provides a full name)
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : ''; // If last name exists

            // Prompt user for address and mobile if Google doesn't provide them (or handle them manually)

            // Find or create a user with additional fields
            $user = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail(),
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'google_id' => $googleUser->getId(),
                    'username' => 34,
                    'ev' => 1,
                    'sv' => 1,
                    // 'avatar' => $googleUser->getAvatar(),
                ]
            );

            // Log the user in
            Auth::login($user);

            return redirect('on-boarding'); // Redirect to home or desired route

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
