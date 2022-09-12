<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Ingredient extends Model
{
    use HasFactory, Sortable;

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
        'category_id' => 'integer',
        'vgn' => 'boolean',
        'veg' => 'boolean',
        'gf' => 'boolean'
    ];

    public $sortable = [
        'title',
        'category_id',
        'category:id,title',
        'energy',
        'protein',
        'carbohydrate',
        'fat',
        'vgn',
        'veg',
        'gf'
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
