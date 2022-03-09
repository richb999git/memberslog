<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stuff - not needed
        </h2>
    </x-slot>

    <div class="p-12">
        <table>
            <tr>
                <td>User name:</td>
                <td class="pl-10">{{ $user->user_name }}</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td class="pl-10">{{ $user->forename }} {{ $user->surname }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td class="pl-10">{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Membership type:</td>
                <td class="pl-10">{{ $user->membership_type ? $user->membership_type->name : 'None' }}</td>
            </tr>
            <tr>
                <td>Membership end date:</td>
                <td class="pl-10">{{ $user->membership_end_date ? date('d-M-Y', strtotime($user->membership_end_date)) : 'None' }}</td>
            </tr>
            <tr>
                <td>Payment for above:</td>
                <td class="pl-10">No</td>
            </tr>
            <tr>
                <td>Member notes:</td>
                <td class="pl-10">{{ $user->member_notes }}</td>
            </tr>
            @if ($user->membership_lapsed)
                <tr>Membership lapsed</tr>
            @endif
        </table>
        <br/>
        <a href="membershipPersonalDetails/edit" class="mb-1 p-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">Edit</a>
    </div>
</x-app-layout>
