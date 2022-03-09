<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MembershipPersonalDetailsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('membershipDetails.edit', ['user' =>  Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validation = [
            'forename' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255', 'min:2']
        ];

        // Only validate user_name if provided (i.e. field not disabled because it is main administrator)
        if (isset($request->user_name)) {
            $validation = array_merge($validation, array('user_name' => ['required', 'string', 'max:255', 'min:2']));
        };

        if ($user->email !== $request->email) {
            $validation = array_merge($validation, array('email' => ['required', 'string', 'email', 'max:255', 'unique:users']));
        };

        $request->validate($validation);

        if ($user->user_name !== $_ENV['ADMIN_USER_NAME']) {
            $user->user_name = $request->user_name;
        }

        $user->forename = $request->forename;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->member_notes = $request->member_notes;
        $user->update();

        return redirect()->route('home');
    }
}
