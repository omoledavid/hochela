<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogleUser()
    {
        return Socialite::driver('google')
            ->with(['state' => 'user'])
            ->redirect();
    }

    public function redirectToGoogleOwner()
    {
        return Socialite::driver('google')
            ->with(['state' => 'owner'])
            ->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $state = $request->input('state'); // This will be 'user' or 'owner'

            // Retrieve Google user details
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Split the name into firstname and lastname
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

            // Generate a unique username
            $username = $this->generateUniqueUsername($firstName, $lastName);

            if ($state === 'user') {
                // Find or create a User
                $user = User::updateOrCreate(
                    ['email' => $googleUser->getEmail()],
                    [
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'google_id' => $googleUser->getId(),
                        'username' => $username,
                        'ev' => 1,
                        'sv' => 1,
                        // 'avatar' => $googleUser->getAvatar(),
                    ]
                );

                // Log the user in
                Auth::login($user);

                return redirect('on-boarding'); // Redirect to home or desired route
            } elseif ($state === 'owner') {
                // Find or create an Owner
                $owner = Owner::updateOrCreate(
                    ['email' => $googleUser->getEmail()],
                    [
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'google_id' => $googleUser->getId(),
                        'username' => $username,
                        'ev' => 1,
                        'sv' => 1,
                        // 'avatar' => $googleUser->getAvatar(),
                    ]
                );

                // Log the owner in
                Auth::guard('owner')->login($owner);

                return redirect()->route('owner.dashboard'); // Redirect to home or desired route
            }

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Generate a unique username based on first and last name.
     *
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    private function generateUniqueUsername($firstName, $lastName)
    {
        // Start with a base username
        $baseUsername = strtolower($firstName . $lastName);
        $username = $baseUsername;
        $counter = 1;

        // Check if the username is already taken in either User or Owner table
        while (User::where('username', $username)->exists() || Owner::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
