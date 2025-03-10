<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Available Meal Plans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Loop through each meal plan -->
                        @foreach ($mealPlans as $mealPlan)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <!-- Display meal image -->
                            <img src="{{ asset(  $mealPlan->image_url) }}" class="w-full h-48 object-cover" alt="Meal Image">

                            <div class="p-4">
                                <!-- Display meal name -->
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $mealPlan->name }}</h3>

                                <!-- Display meal description -->
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $mealPlan->description }}</p>

                                <!-- Display meal price -->
                                <p class="mt-2 text-xl font-bold text-gray-900 dark:text-gray-100">${{ number_format($mealPlan->price, 2) }}</p>

                                <!-- Subscribe button (link) -->
                                <a href="{{ route('payment') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600">
                                    Subscribe Now
                                </a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>