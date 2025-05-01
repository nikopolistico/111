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
                    <!-- Search Bar -->
                    <div class="mb-6">
                        <input
                            id="searchBar"
                            type="text"
                            placeholder="Search for a meal..."
                            class="w-full py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            onkeyup="filterMeals()" />
                    </div>

                    <!-- Filters and Sort Options -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-md">All Recipes</button>
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Breakfasts</button>
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Lunches</button>
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Snacks</button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Filters</button>
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Sort</button>
                        </div>
                    </div>

                    <!-- Meal Plan Grid -->
                    <div id="mealPlanGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($mealPlans as $mealPlan)
                        <div class="meal-card bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden transition transform hover:scale-105 hover:shadow-2xl">
                            <!-- Meal Image -->
                            <div class="relative group">
                                <img src="{{ asset($mealPlan->image_url) }}" class="w-full h-48 object-cover rounded-t-lg cursor-pointer" alt="Meal Image" onclick="openModal('{{ asset($mealPlan->image_url) }}', '{{ $mealPlan->name }}', '{{ $mealPlan->description }}', '{{ $mealPlan->price }}')">
                                <div class="absolute bottom-4 left-4 bg-white bg-opacity-75 px-4 py-2 rounded-full text-gray-900">{{ $mealPlan->time }} mins</div>

                                <!-- Hover "Click Me" Text -->
                                <div class="absolute inset-0 flex justify-center items-center opacity-0 group-hover:opacity-100 transition duration-300 text-gray-900 text-xl font-bold cursor-pointer" onclick="openModal('{{ asset($mealPlan->image_url) }}', '{{ $mealPlan->name }}', '{{ $mealPlan->description }}', '{{ $mealPlan->price }}')">
                                    Click Me
                                </div>
                            </div>

                            <!-- Meal Information -->
                            <div class="p-4 d-flex">
                                <!-- Meal Name -->
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $mealPlan->name }}</h3>
                                <!-- Meal Tag -->
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $mealPlan->category }}</p>

                                <!-- Action Button -->
                                <a href="{{ route('payment') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
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

    <!-- Modal for image enlargement -->
    <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50 mt-52" onclick="closeModal()">
        <div class="relative flex justify-center items-center w-full h-[60vh] max-h-[70vh] bg-gray rounded-lg p-4">
            <img id="modalImage" src="" class="max-w-full max-h-full object-contain" alt="Large Meal Image">
            <div id="modalInfo" class="absolute bottom-4 justify-center text-white bg-gray-900 bg-opacity-75 px-4 py-2 rounded-lg">
                <!-- Price and Description will be inserted here -->
            </div>
            <button class="absolute top-2 right-2 text-white text-2xl" onclick="closeModal()">×</button>
        </div>
    </div>

    <script>
        // Function to filter meal plans based on search input
        function filterMeals() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let meals = document.querySelectorAll(".meal-card");

            meals.forEach(function(meal) {
                let mealName = meal.querySelector("h3").textContent.toLowerCase();
                if (mealName.includes(searchQuery)) {
                    meal.style.display = "block";
                } else {
                    meal.style.display = "none";
                }
            });
        }

        // Function to open the modal with the clicked image
        function openModal(imageUrl, name, description, price) {
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalInfo').innerHTML = `
                <h3 class="text-xl font-semibold text-center mt-10">Name: ${name}</h3>
                <p class="text-xl text-center mt-10">Description<br></br> ${description}</p>
                <p class="mt-4 text-lg font-bold text-center">Price: $${price}</p>
            `;
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>