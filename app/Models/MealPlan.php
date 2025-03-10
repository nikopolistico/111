<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MealPlan extends Model
{
    //
    use HasFactory;

    protected $table = 'meal_plans';

    protected $fillable = ['name', 'description', 'price', 'image_url'];
}
