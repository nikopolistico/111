<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Storage;

class MealPlanController extends Controller
{
    /**
     * Show the list of available meal plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all meal plans from the database
        $mealPlans = MealPlan::all(); // Or you can use pagination if the list is large

        return view('dashboard', compact('mealPlans'));
    }

    public function mealcreate()
    {
        return view('mealplans.create');
    }
    /**
     * Store a newly created meal plan and its image in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle the image upload
        $imagePath = $request->file('image')->store('/meal_images'); // Store the image in the 'meal_images' folder

        // Generate the URL to access the image
        $imageUrl = Storage::url($imagePath); // This will return the path to the public URL of the image

        // Create a new meal plan with the validated data and image URL
        $mealPlan = new MealPlan([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image_url' => $imageUrl, // Store the image URL in the database
        ]);

        // Save the meal plan to the database
        $mealPlan->save();

        // Redirect back to the meal plans page or any desired route with a success message
        return redirect()->route('meal.home')->with('status', 'Meal Plan created successfully!');
    }
}
