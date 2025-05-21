<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('DXDY Available Meal Plans') }}
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
                                <img src="{{ asset($mealPlan->image_url) }}" class="w-full h-48 object-cover rounded-t-lg cursor-pointer"
                                     alt="Meal Image"
                                     onclick="openModal('{{ asset($mealPlan->image_url) }}', '{{ $mealPlan->name }}', '{{ $mealPlan->description }}', '{{ $mealPlan->price }}', '{{ $mealPlan->delivery_schedule ?? 'To be scheduled' }}')">
                                <div class="absolute bottom-4 left-4 bg-white bg-opacity-75 px-4 py-2 rounded-full text-gray-900">{{ $mealPlan->time }} mins</div>

                                <!-- Hover "Click Me" Text -->
                                <div class="absolute inset-0 flex justify-center items-center opacity-0 group-hover:opacity-100 transition duration-300 text-gray-900 text-xl font-bold cursor-pointer"
                                     onclick="openModal('{{ asset($mealPlan->image_url) }}', '{{ $mealPlan->name }}', '{{ $mealPlan->description }}', '{{ $mealPlan->price }}', '{{ $mealPlan->delivery_schedule ?? 'To be scheduled' }}')">
                                    Click Me
                                </div>
                            </div>

                            <!-- Meal Information -->
                            <div class="p-4 d-flex">
                                <!-- Meal Name -->
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $mealPlan->name }}</h3>
                                <!-- Meal Tag -->
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $mealPlan->category }}</p>

                                <!-- Clickable Delivery Schedule -->
                                <button
                                    type="button"
                                    class="text-sm text-orange-600 dark:text-orange-400 mt-2 font-medium underline cursor-pointer"
                                    onclick="openSchedulePicker('{{ $mealPlan->id }}', '{{ $mealPlan->delivery_schedule ?? '' }}')"
                                >
                                    Delivery: <span id="schedule-text-{{ $mealPlan->id }}">{{ $mealPlan->delivery_schedule ?? 'Click to schedule' }}</span>
                                </button>

                                <!-- Action Button -->
                                <a href="{{ route('payment') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                                    subscribe Now
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
        <div class="relative flex justify-center items-center w-full h-[60vh] max-h-[70vh] bg-gray rounded-lg p-4" onclick="event.stopPropagation()">
            <img id="modalImage" src="" class="max-w-full max-h-full object-contain" alt="Large Meal Image">
            <div id="modalInfo" class="absolute bottom-4 justify-center text-white bg-gray-900 bg-opacity-75 px-4 py-2 rounded-lg max-w-lg text-center">
                <!-- Price, Description, Delivery Schedule will be inserted here -->
            </div>
            <button class="absolute top-2 right-2 text-white text-2xl" onclick="closeModal()">×</button>
        </div>
    </div>

    <!-- Modal for delivery schedule picker -->
    <div id="scheduleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-80 max-w-full">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Select Delivery Schedule</h3>

            <input type="datetime-local" id="scheduleInput" class="w-full p-2 rounded border border-gray-300 dark:border-gray-600 text-black-900 dark:text-gray-100" />

            <div class="mt-4 flex justify-end space-x-4">
                <button class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" onclick="closeSchedulePicker()">Cancel</button>
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="saveSchedule()">Save</button>
            </div>
        </div>
    </div>

    <script>
        // Filter meals on search
        function filterMeals() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let meals = document.querySelectorAll(".meal-card");

            meals.forEach(function(meal) {
                let mealName = meal.querySelector("h3").textContent.toLowerCase();
                meal.style.display = mealName.includes(searchQuery) ? "block" : "none";
            });
        }

        // Modal open/close for meal image
        function openModal(imageUrl, name, description, price, deliverySchedule) {
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalInfo').innerHTML = `
                <h3 class="text-xl font-semibold mt-2">${name}</h3>
                <p class="mt-4">${description}</p>
                <p class="mt-4 font-bold">Price: $${price}</p>
                <p class="mt-2 font-semibold text-orange-400">Delivery: ${deliverySchedule}</p>
            `;
        }
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Schedule picker modal logic with localStorage
        let currentMealId = null;

        function openSchedulePicker(mealId, currentSchedule) {
            currentMealId = mealId;
            const modal = document.getElementById('scheduleModal');
            const input = document.getElementById('scheduleInput');

            // Load saved schedule from localStorage if available
            const savedSchedule = localStorage.getItem(`deliverySchedule-${mealId}`);
            if (savedSchedule) {
                input.value = savedSchedule;
            } else if (currentSchedule) {
                input.value = new Date(currentSchedule).toISOString().slice(0,16);
            } else {
                input.value = '';
            }

            modal.classList.remove('hidden');
        }

        function closeSchedulePicker() {
            document.getElementById('scheduleModal').classList.add('hidden');
            currentMealId = null;
        }

        function saveSchedule() {
            const input = document.getElementById('scheduleInput');
            const newSchedule = input.value;

            if (!newSchedule) {
                alert('Please select a delivery date and time.');
                return;
            }

            // Update displayed text
            document.getElementById(`schedule-text-${currentMealId}`).textContent = new Date(newSchedule).toLocaleString();

            // Save to localStorage
            localStorage.setItem(`deliverySchedule-${currentMealId}`, newSchedule);

            closeSchedulePicker();
        }

        // On page load, update all schedule texts from localStorage if available
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('button[id^="schedule-text-"]').forEach(span => {
                const id = span.id || '';
                if (!id.startsWith('schedule-text-')) return;
                const mealId = id.replace('schedule-text-', '');
                const savedSchedule = localStorage.getItem(`deliverySchedule-${mealId}`);
                if (savedSchedule) {
                    span.textContent = new Date(savedSchedule).toLocaleString();
                }
            });
        });
    </script>
</x-app-layout>

<style>
  #scheduleInput {
    color: black;
  }
  #scheduleInput::placeholder {
    color: black;
    opacity: 1;
  }
</style>
