<x-app-layout>
    <div class="p-12">
        <div class="text-xl">
            Members {{ $filter ? '(current)' : '(all)' }}
            @if ($filter)
                <div class="inline float-right">
                    <form action="{{ url('members/showAll') }}" method="GET">
                        {{ csrf_field() }}
                        <button class="text-sm ml-4 p-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                            Show all members
                        </button>
                    </form>
                </div>
            @endif
            @if (!$filter)
                <div class="inline float-right">
                    <form action="{{ url('members') }}" method="GET">
                        {{ csrf_field() }}
                        <button class="text-sm ml-4 p-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                            Show current members
                        </button>
                    </form>
                </div>
            @endif
        </div>
        <br/>
        <table>
            <tr>
                <td class="pl-10">User name</td>
                <td class="pl-10">Forename</td>
                <td class="pl-10">Surname</td>
                <td class="pl-10">Email</td>
                <td class="pl-10">Membership type</td>
                <td class="pl-10">Membership end date</td>
                <td class="pl-10">Administrator?</td>
                <td class="pl-10">Membership lapsed?</td>
            </tr>
            @foreach ($members as $member)
                <tr class="leading-8">
                    <td class="pl-10">{{ $member->user_name }}</td>
                    <td class="pl-10">{{ $member->forename }}</td>
                    <td class="pl-10">{{ $member->surname }}</td>
                    <td class="pl-10">{{ $member->email }}</td>
                    <td class="pl-10">{{ $member->membership_type ? $member->membership_type->name : 'None' }}</td>
                    <td class="pl-10">{{ $member->membership_end_date }}</td>
                    <td class="pl-10">{{ $member->is_admin ? 'Yes' : 'No'}}</td>
                    <td class="pl-10">{{ $member->membership_lapsed ? 'Yes' : 'No'}}</td>
                    <td class="pl-4">
                        <form action="{{ url('members/edit', $member ) }}" method="GET">
                            {{ csrf_field() }}
                            <button class="ml-4 mb-1 pr-2 pl-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                                Edit
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>