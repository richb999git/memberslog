<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Username -->
            <div>
                <x-label for="user_name" :value="__('Username')" />

                <x-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Forename -->
            <div class="mt-4">
                <x-label for="forename" :value="__('Forename')" />

                <x-input id="forename" class="block mt-1 w-full" type="text" name="forename" :value="old('forename')" required autofocus />
            </div>

            <!-- Surname -->
            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus />
            </div>

            <!-- Membership type -->
            <div class="mt-4">
                <x-label for="membership_type" :value="__('Membership type')" />
                <select name="membership_type" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm w-full">
                    <option value="">None</option>
                    @foreach ($membership_types as $membership_type)
                        <option value="{{ $membership_type->id }}" {{ $membership_type->id == old("membership_type") ? "selected" : "" }}>{{ $membership_type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Membership end date -->
            <div class="mt-4">
                <x-label for="membership_end_date" :value="__('Membership end date')" />

                <x-input id="membership_end_date" class="block mt-1 w-full" type="date" name="membership_end_date" :value="old('membership_end_date')" autofocus />
            </div>

            <!-- Is Administrator? -->
            <div class="block mt-4">
                <x-label for="is_admin">
                    <input name="is_admin" type="checkbox" @if(old('is_admin')) checked @endif class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Administrator?') }}</span>
                </x-label>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
