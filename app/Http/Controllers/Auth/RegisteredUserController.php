<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ProfilePicture;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        // Default image path
        $defaultImagePath = $this->getDefaultImagePath($user->gender);

        // Create a profile picture for the user
        ProfilePicture::create([
            'user_id' => $user->id,
            'url' => $defaultImagePath,
            'is_primary' => true, // Set as the primary profile picture
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));

    }
    private function getDefaultImagePath(string $gender): string
    {
        $basePath = 'images/profile_pictures/';

        return match ($gender) {
            'male' => $basePath . 'male.png',
            'female' => $basePath . 'female.png',
            'other' => $basePath . 'other.png',
            'default' => $basePath . 'default.png',
        };
    }
}
