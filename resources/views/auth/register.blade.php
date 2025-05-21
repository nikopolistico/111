<x-guest-layout>
    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 ms-4 bg-gray-600 hover:text-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 rounded-md text-white font-semibold">
        {{ __('Login') }}
    </a>
    <div class="max-w-m mx-auto bg-white dark:bg-gray-800 rounded-lg p-8 mt-5" style="box-shadow: 0 10px 25px -5px rgba(249, 115, 22, 0.7);">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-gray-200" />
                <x-text-input id="name" class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring focus:ring-green-200 dark:focus:ring-green-700" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-200" />
                <x-text-input id="email" class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring focus:ring-green-200 dark:focus:ring-green-700" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-200" />
                <x-text-input id="password" class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring focus:ring-green-200 dark:focus:ring-green-700" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-200" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring focus:ring-green-200 dark:focus:ring-green-700" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 bg-green-600 hover:bg-green-700 focus:ring-green-500">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
