<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'energy',
        'protein',
        'carbohydrate',
        'fat',
        'vgn',
        'veg',
        'gf'
    ];

    protected $casts = [
        'vgn' => 'boolean',
        'veg' => 'boolean',
        'gf' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function lockedIngredients()
    {
        return $this->belongsToMany(User::class,'ingredient_user','ingredient_id','user_id','id','id');
    }

}
