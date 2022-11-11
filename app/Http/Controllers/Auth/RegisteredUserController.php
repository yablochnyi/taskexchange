<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/SignUpView');
    }

    /**
     * Handle an incoming registration request.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\RedirectResponse
//     *
//     * @throws \Illuminate\Validation\ValidationException
//     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'firstName' => 'required',
            'lastName' => 'required',
            'accountType' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'role_id' => $request->accountType,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('message', 'Вы успешно зарегестрировались');
    }
}
