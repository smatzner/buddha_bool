<?php

/**
 * Return true if logged in User and locked ingredient match
 *
 * @param   \App\Models\Ingredient  $ingredient    
 * @param   int  $ingredient_id
 * @param   int  $user_id        logged in user auth()->user()->id
 *
 * @return  [type]                  [return description]
 */
function lockedIngredients ($ingredient,int $ingredient_id,int $user_id){ 

    foreach ($ingredient->lockedIngredients as $lockedIngredient){
        if(($lockedIngredient->pivot->ingredient_id == $ingredient_id) && ($lockedIngredient->pivot->user_id == $user_id)){
            return true;
        }
    }
}