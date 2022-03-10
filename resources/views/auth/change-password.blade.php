<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ isset($member) && $member === true ? route('changeMemberPassword') : route('changePassword') }}">
            @csrf

            <!-- Email Address if -->
            @if (isset($member) && $member === true)
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>
            @endif

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{url('membershipTypes')}}" class="btn btn-default mr-3 p-3 rounded-lg text-xs hover:bg-gray-100">CANCEL</a>
                <x-button>
                    {{ __('Change Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

    <div class="{{$hidden}}">
        <div class="bg-slate-800 bg-opacity-50 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0">
            <div class="bg-white px-16 py-14 text-center rounded-md shadow-lg">
                <h1 class="text-xl mb-4 font-bold text-slate-500">Password change error</h1>
                <p class="text-md mb-4 text-slate-500">Cannot change the password.</p>
                <a
                    href="{{ url('changeMemberPassword') }}"
                    class="ml-0 mb-1 p-2 pr-4 pl-4 rounded-sm ring-2 bg-indigo-200 text-black-600 hover:bg-indigo-400 hover:text-white">
                    OK
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>