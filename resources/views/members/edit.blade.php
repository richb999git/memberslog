<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ url('members/update', $member) }}">
            @csrf
            {{ method_field('PUT') }}
            <!-- Username -->
            <div>
                <x-label for="user_name" :value="__('Username')"/>

                <x-input title="Read only - for info only" id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name', $member->user_name)" disabled/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input title="Read only - for info only" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $member->email)" disabled/>
            </div>

            <!-- Forename -->
            <div class="mt-4">
                <x-label for="forename" :value="__('Forename')" />

                <x-input title="Read only - for info only" id="forename" class="block mt-1 w-full" type="text" name="forename" :value="old('forename', $member->forename)" disabled/>
            </div>

            <!-- Surname -->
            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <x-input title="Read only - for info only" id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $member->surname)" disabled/>
            </div>


            <!-- Membership type -->
            <div class="mt-4">
                <x-label for="membership_type" :value="__('Membership type')" />
                <select
                    name="membership_type"
                    class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm w-full"
                    autofocus
                >
                    <option value="">None</option>
                    @foreach ($membership_types as $membership_type)
                        <option value="{{ $membership_type->id }}" {{ $membership_type->id == old("membership_type", $member->membership_type ? $member->membership_type->id : null) ? "selected" : "" }}>
                            {{ $membership_type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Membership end date -->
            <div class="mt-4">
                <x-label for="membership_end_date" :value="__('Membership end date')" />

                <x-input
                    id="membership_end_date"
                    class="block mt-1 w-full"
                    type="date"
                    name="membership_end_date"
                    :value="old('membership_end_date', $member->membership_end_date ? date('Y-m-d', strtotime($member->membership_end_date)) : null)"
                />
            </div>

            <!-- Is Administrator? -->
            <div class="block mt-4">
                <x-label for="is_admin">
                <input
                    name="is_admin"
                    type="checkbox"
                    {{$member->user_name === $_ENV['ADMIN_USER_NAME'] ? 'disabled' : ''}}
                    value="1"
                    @if($errors->any() && old('is_admin') == '1')checked @elseif($errors->any() && !old('is_admin')) @else {{ $member->is_admin ? 'checked' : '' }} @endif
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Administrator?') }}</span>
                </x-label>
            </div>

            <!-- Admin's notes on member -->
            <div class="mt-4">
                <x-label for="admin_notes" :value="__('Admin\'s notes on member')" />

                <div>
                    <textarea
                        id="admin_notes"
                        class="shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md mt-1 w-full"
                        name="admin_notes"
                        rows="5"
                    >{{ old('admin_notes', $member->admin_notes)}}</textarea>
                </div>
            </div>

            <!-- Has membership lapsed/been cancelled? if there is an old value use it but not if null-->
            <div class="block mt-4">
                <x-label for="membership_lapsed">
                <input
                    name="membership_lapsed"
                    type="checkbox"
                    value="1"
                    @if($errors->any() && old('membership_lapsed') == '1')checked @elseif($errors->any() && !old('membership_lapsed')) @else {{ $member->membership_lapsed ? 'checked' : '' }} @endif
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Membership lapsed/cancelled?') }}</span>
                </x-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{url('members')}}" class="btn btn-default p-3 rounded-lg text-xs hover:bg-gray-100">CANCEL</a>
                <x-button class="ml-3">
                    Update
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
