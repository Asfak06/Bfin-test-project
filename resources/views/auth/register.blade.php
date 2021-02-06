<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <!-- Date of birth -->
            <div>
                <x-label for="birthday" :value="__('birthday')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus />
            </div>
            <!--Phone-->
            <div>
                <x-label for="phone" :value="__('phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
            </div>

            <!--Gender-->

            <div class="mt-4">
              <span class="text-gray-700">Gender</span>
              <div class="mt-2">
                <label class="inline-flex items-center">
                  <input type="radio" class="form-radio" name="gender" value="male"  required >
                  <span class="ml-2">Male</span>
                </label>
                <label class="inline-flex items-center ml-6">
                  <input type="radio" class="form-radio" name="gender" value="female">
                  <span class="ml-2">Female</span>
                </label>
              </div>
            </div>


             <!--image-->
            <div>
                <x-label for="image" :value="__('image')" />
                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autofocus />
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
