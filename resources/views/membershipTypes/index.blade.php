<x-app-layout>
    <div class="p-12">
        <div class="text-xl">Membership types
            <a class="ml-4 pt-0 pb-0 pr-2 pl-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white"
               title="Add a membership type"
               href={{ url('membershipTypes/create') }}
            >
                +
            </a>
        </div>
        <br/>
        <table>
            <tr>
                <td class="pl-10">Name</td>
                <td class="pl-10">Description</td>
                <td class="pl-10">Price</td>
            </tr>
            @for ($i = 0 ; $i < count($membership_types) ; $i++)
                <tr class="leading-8">
                    <td class="pl-10">{{ $membership_types[$i]->name }}</td>
                    <td class="pl-10">{{ $membership_types[$i]->description }}</td>
                    <td class="pl-10">£{{ $membership_types[$i]->year_price }}</td>
                    <td class="pl-4">
                        <form action="{{ url('membershipTypes/edit', $membership_types[$i] ) }}" method="GET">
                            {{ csrf_field() }}
                            <button class="ml-4 mr-0.5 mb-1 pr-2 pl-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                                Edit
                            </button>
                        </form>
                    </td>
                    @if ($can_delete_array[$i])
                        <td class="pl-1">
                            <form action="{{ url('membershipTypes/delete', $membership_types[$i] ) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="ml-0 mb-1 pr-2 pl-2 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                                    Del
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endfor
        </table>

        <div class="{{$hidden}}">
            <div class="bg-slate-800 bg-opacity-50 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0">
                <div class="bg-white px-16 py-14 text-center rounded-md shadow-lg">
                    <h1 class="text-xl mb-4 font-bold text-slate-500">Cannot delete</h1>
                    <p class="text-md mb-4 text-slate-500">Type has been used by a member.</p>
                    <a
                        href="{{ url('membershipTypes') }}"
                        class="ml-0 mb-1 p-2 pr-4 pl-4 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                        OK
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>