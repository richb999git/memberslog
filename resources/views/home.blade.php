<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stuff - not needed
        </h2>
    </x-slot>

    <div class="py-12">
        @if (Auth::user()->is_admin)
            Main stuff here (when logged in). Show members list.
        @else
            Main stuff here (when logged in). Show the member's page.
        @endif
    </div>
</x-app-layout>
