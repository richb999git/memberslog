<x-guest-layout>
    <x-auth-card>
        <div class="pb-10">
            <div>Add membership type</div>
        </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('membershipTypes') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <div>
                    <x-label for="description" :value="__('Description')" />

                    <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
                </div>

                <div>
                    <x-label for="price" :value="__('Price')" />

                    <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{url('membershipTypes')}}" class="btn btn-default p-3 rounded-lg text-xs hover:bg-gray-100">CANCEL</a>
                    <x-button class="ml-3">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
</x-guest-layout>