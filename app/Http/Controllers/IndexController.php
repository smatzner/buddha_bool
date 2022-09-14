<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Index;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    // TODO: doc
    public function generate(Request $request)
    {
        $ingredients = [];
        $categoryCount = Category::all()->count();

        if(isset(auth()->user()->id)){
            $userId = auth()->user()->id;
            for ($i=1; $i <= $categoryCount; $i++) {
                $ingredient = Ingredient::where('category_id',$i)->whereDoesntHave('lockedIngredients', function($query) use ($userId) { $query->where('user_id',$userId);})->inRandomOrder()->first();
                array_push($ingredients,$ingredient);
            }
        }
        else{
            for ($i=1; $i <= $categoryCount; $i++) {
                $ingredient = Ingredient::where('category_id',$i)->where('user_id',NULL)->inRandomOrder()->first();
                array_push($ingredients,$ingredient);
            }
        }

        if(in_array(NULL,$ingredients)){
            return redirect()->back()->with('error','Es ist ein Fehler aufgetreten, überprüfen Sie Ihre Zutatenliste!');
        }

        // Delete all recipes with user_id = NULL
        $recipes = Recipe::all();
        foreach($recipes as $recipe){
            if(!$recipe->user_id){
                $recipe->delete();
            }
        }

        $recipe = new Recipe();
        if(isset(auth()->user()->id)){
            $recipe->user_id = auth()->user()->id;
        }
        $recipe->save();
        $ingredientsRecipe = [];
        foreach($ingredients as $ingredient){
            array_push($ingredientsRecipe,$ingredient->id);
        }
        $recipe->ingredients()->sync($ingredientsRecipe);
        

        
        
        return view('index',compact('ingredients'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function show(Index $index)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function edit(Index $index)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Index $index)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function destroy(Index $index)
    {
        //
    }

    public function pdf(Index $index, Request $request, Recipe $recipe){
        $recipe = Recipe::where('user_id',NULL)->get()[0];
        // dump($recipe);
        $recipeIngredients = $recipe->ingredients()->get();
        
        // dd($recipeIngredients);

        // $pdf = Pdf::loadView('pdf',compact('recipeIngredients'));
        return view('pdf',compact('recipeIngredients'));
        // return $pdf->download('Rezept.pdf');
    }
}
