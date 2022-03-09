<?php

namespace App\Http\Controllers;

use App\Models\MembershipType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipTypeController extends Controller
{
    private function getCanDeleteArray($types) {
        $canDeleteArray = [];

        foreach($types as $type) {
            $type_is_used = User::where('membership_type_id', $type->id)->count() > 0;

            if ($type_is_used) {
                array_push($canDeleteArray, false);
            } else {
                array_push($canDeleteArray, true);
            }
        };

        return $canDeleteArray;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        $types = MembershipType::all();

        $canDeleteArray = $this->getCanDeleteArray($types);

        return view('membershipTypes.index', [
            'membership_types' => MembershipType::all(),
            'hidden' => 'hidden',
            'can_delete_array' => $canDeleteArray
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        return view('membershipTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new MembershipType();
        $type->name = $request->name;
        $type->description = $request->description;
        $type->year_price = $request->price;
        $type->save();

        return redirect()->route('membershipTypes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipType $membershipType)
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) return redirect()->route('home');

        return view('membershipTypes.edit', ['membership_type' => $membershipType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipType $membershipType)
    {
        $membershipType->name = $request->name;
        $membershipType->description = $request->description;
        $membershipType->year_price = $request->price;
        $membershipType->update();

        return redirect()->route('membershipTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipType $membershipType)
    {
        $can_delete = User::where('membership_type_id', $membershipType->id)->where('membership_lapsed', false)->count() === 0;

        $types = MembershipType::all();

        if ($can_delete) {
            $membershipType->delete();
        } else {
            return view('membershipTypes.index', [
                'membership_types' => $types,
                'hidden' => '',
                'can_delete_array' => $this->getCanDeleteArray($types)
            ]);
        }

        return redirect()->route('membershipTypes.index');
    }
}
