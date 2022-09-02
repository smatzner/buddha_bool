<?php

/**
 * Return true if logged in User and locked ingredient match
 *
 * @param   \App\Models\Ingredient  $ingredient    
 * @param   int  $ingredient_id
 * @param   int  $user_id        logged in user auth()->user()->id
 *
 * @return  bool                  [return description]
 */
function lockedIngredients ($ingredient,int $ingredient_id,int $user_id){ 

    foreach ($ingredient->lockedIngredients as $lockedIngredient){
        if(($lockedIngredient->pivot->ingredient_id == $ingredient_id) && ($lockedIngredient->pivot->user_id == $user_id)){
            return true;
        }
    }
}

// TODO: doc
function csvToArray($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE)
        {

            if(!$header)
            {
            $header = $row;
            }
            else
            {
                if(count($header)!=count($row)){ continue; }

                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return ($data);
}