<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ url('membershipPersonalDetails/update', $user) }}">
            @csrf
            {{ method_field('PUT') }}
            <!-- Username -->
            <div>
                <x-label for="user_name" :value="__('Username')" />

                <x-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" value="{{old('user_name', $user->user_name)}}" disabled="{{$user->user_name === $_ENV['ADMIN_USER_NAME'] ? 'disabled' : ''}}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autofocus/>
            </div>

            <!-- Forename -->
            <div class="mt-4">
                <x-label for="forename" :value="__('Forename')" />

                <x-input id="forename" class="block mt-1 w-full" type="text" name="forename" :value="old('forename', $user->forename)" required autofocus />
            </div>

            <!-- Surname -->
            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $user->surname)" required autofocus />
            </div>

            <!-- Member's notes -->
            <div class="mt-4">
                <x-label for="member_notes" :value="__('Member\'s notes')" />

                <div>
                    <textarea
                        id="member_notes"
                        class="shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md mt-1 w-full"
                        name="member_notes"
                        rows="5"
                        autofocus
                    >{{ old('member_notes', $user->member_notes)}}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="/" class="btn btn-default p-3 rounded-lg text-xs hover:bg-gray-100">CANCEL</a>
                <x-button class="ml-3">
                    Update
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
