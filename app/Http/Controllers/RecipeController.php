<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with(['ingredients' => function ($q){
            $q->orderBy('category_id');
        }])->where('user_id',Auth::user()->id)->orderBy('is_bookmarked','desc')->orderBy('created_at')->get();
        $categoriesCount = Category::get()->count();

        // Rezept rauslöschen, wenn eine Zutat fehlt

        return view('recipe.index',compact('recipes','categoriesCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $recipeIngredients = $recipe->ingredients()->orderBy('category_id')->get();
        $ingredients = Ingredient::select('id','category_id','title')->get();
        $categories = Category::select('id','title')->get();
        $categoriesCount = Category::get()->count();

        // dd($recipe[0]);


        return view('recipe.edit',compact('recipe','recipeIngredients','ingredients','categories','categoriesCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $categories = Category::select('id','title')->get();
        $categoriesCount = Category::get()->count();
        $recipeIngredients = [];

        for ($i=0; $i < $categoriesCount; $i++) { 
            $request->validate([
                ''.$categories[$i]->title.'' => 'required|exists:ingredients,id' // TODO: Mit Kategorie validieren
            ]);  
        }

        for ($i=0; $i < $categoriesCount; $i++) { 
            $category = $categories[$i]->title;
            array_push($recipeIngredients,$request->$category);
        }
        $recipe->ingredients()->sync($recipeIngredients);

        return redirect()->route('recipe.index')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe  = Recipe::find($id);
        
        if(!$recipe){
            $status = 404;
            $msg = 'Zutat nicht gefunden.';
        }
        else{
            $recipe->delete();
            $status = 200;
            $msg = 'Rezept wurde erfolgreich gelöscht.';
        }
        
        // Aufruf per JavaScript
        if(request()->ajax()){
            return response()->json([
                'status' => $status,
                'msg' => $msg
            ], $status);
        }
        
        // Aufruf per HTML
        if($status == 404){
            abort(404);
        }

        return redirect()->route('recipe.index')->with('success', $msg);
    }

    // TODO: doc
    public function bookmark(Request $request, Recipe $recipe){
        $recipe->is_bookmarked ? $recipe->is_bookmarked = false : $recipe->is_bookmarked = true;
        $recipe->save();

        return redirect()->route('recipe.index');
    }
}
