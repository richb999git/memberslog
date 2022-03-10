<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Input;

class ChangePasswordController extends Controller
{
    /**
     * Display the change password view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('auth.change-password', ['request' => $request, 'member' => false, 'hidden' => 'hidden']);
    }

    /**
     * Display the change password view for Admin to change any member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function editMember(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        return view('auth.change-password', ['request' => $request, 'member' => true, 'hidden' => 'hidden']);
    }

    /**
     * Handle a change of password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->route('home');
    }

    /**
     * Handle a change of password request for Admin to update any user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeMember(Request $request)
    {
        $member = User::where('email', $request->email)->first();

        if (!$member || $member->id === 1) {
            return view('auth.change-password', [
                'request' => $request,
                'member' => true,
                'hidden' => ''
            ]);
        }

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $member->password = Hash::make($request->password);
        $member->update();

        return redirect()->route('home');
    }
}
