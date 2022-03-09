<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MembershipType;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->is_admin) return redirect()->route('home');

        return view('auth.register', [
            'membership_types' => MembershipType::all()
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255', 'min:2'],
            'forename' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'membership_type' => ['required_with:membership_end_date'],
            'membership_end_date' => ['nullable', 'after:today', 'required_with:membership_type']
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'is_admin'=> $request->is_admin ? true : false,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'membership_type_id' => $request->membership_type == "" ? NULL : $request->membership_type,
            'membership_end_date' => $request->membership_end_date
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
