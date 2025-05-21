<x-guest-layout>
    <a href="{{ route('register') }}"
    class="inline-flex items-center px-4 py-2 ms-4 bg-gray-600 hover:text-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 rounded-md text-white font-semibold">
        {{ __('Register') }}
    </a>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg p-8 mt-5" style="box-shadow: 0 10px 25px -5px rgba(249, 115, 22, 0.7);">
        <!-- Optional: Meal Subscription Logo or Icon -->

        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                Welcome Back
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                Log in to continue enjoying your favorite meals delivered fresh to your door.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-200" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring focus:ring-green-200 dark:focus:ring-green-700"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-200" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring focus:ring-green-200 dark:focus:ring-green-700"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="********"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-600 shadow-sm focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-gray-800"
                        name="remember"
                    >
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a
                        class="underline text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 bg-green-600 hover:bg-green-700 focus:ring-green-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
