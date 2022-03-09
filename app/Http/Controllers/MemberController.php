<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MembershipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        return view('members.index', [
            'members' => User::where('membership_lapsed', false)->get()->sortBy('surname'),
            'filter' => true
        ]);
    }

    public function showAll()
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        return view('members.index', [
            'members' => User::all()->sortBy('surname'),
            'filter' => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member)
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        return view('members.edit', [
            'member' => $member,
            'membership_types' => MembershipType::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        $validation = [
            'membership_type' => ['required_with:membership_end_date'],
            'membership_end_date' => ['nullable', 'after:today', 'required_with:membership_type']
        ];

        if (isset($request->email) && $member->email !== $request->email) {
            $validation = array_merge($validation, array('email' => ['required', 'string', 'email', 'max:255', 'unique:users']));
        };

        if ($member->user_name !== $_ENV['ADMIN_USER_NAME']) {
            $member->is_admin = $request->is_admin ? true : false;
        }

        $request->validate($validation);

        $member->membership_type_id = $request->membership_type;
        $member->membership_end_date = $request->membership_end_date;
        $member->admin_notes = $request->admin_notes;
        $member->membership_lapsed = $request->membership_lapsed ? true : false;
        $member->update();

        return redirect()->route('members.index');
    }
}
