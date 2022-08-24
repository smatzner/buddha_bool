<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\IngredientUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::user()->is_admin == 1){
            $ingredients = Ingredient::with('category:id,title')->where('user_id',null)->get();
        }
        else {
            $ingredients = Ingredient::with('lockedIngredients')->with('category:id,title')->where('user_id',null)->orWhere('user_id',Auth::user()->id)->orderBy('user_id','desc')->get();
        }

        return view('ingredient.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'title')->get();
        return view('ingredient.create', compact('categories'));
        //TODO: user / admin unterscheidung
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'category_id' => 'required|exists:categories,id',
            'energy' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbohydrate' => 'required|numeric',
            'fat' => 'required|numeric',
        ]);

        $ingredient = new Ingredient();
        $ingredient->title = $request->title;
        $ingredient->category_id = $request->category_id;
        $ingredient->energy = $request->energy;
        $ingredient->protein = $request->protein;
        $ingredient->carbohydrate = $request->carbohydrate;
        $ingredient->fat = $request->fat;
        $ingredient->vgn = $request->has('vgn');
        $ingredient->veg = $request->has('veg');
        $ingredient->gf = $request->has('gf');
        if(!auth()->user()->is_admin){
            $ingredient->user_id = auth()->user()->id;
        }
        $ingredient->save();

        return redirect()->route('ingredient.index')->with('success', 'Die Zutat '.$ingredient->title.' wurde erfolgreich erstellt.');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        $categories = Category::select('id', 'title')->get();
        return view('ingredient.edit', compact('ingredient', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'title' => 'required|min:2',
            'category_id' => 'required|exists:categories,id',
            'energy' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbohydrate' => 'required|numeric',
            'fat' => 'required|numeric',
        ]);

        $ingredient->title = $request->title;
        $ingredient->category_id = $request->category_id;
        $ingredient->energy = $request->energy;
        $ingredient->protein = $request->protein;
        $ingredient->carbohydrate = $request->carbohydrate;
        $ingredient->fat = $request->fat;
        $ingredient->vgn = $request->has('vgn');
        $ingredient->veg = $request->has('veg');
        $ingredient->gf = $request->has('gf');
        $ingredient->save();
        
        return redirect()->route('ingredient.index')->with('success', 'Zutat '.$request->title.' wurde erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient = Ingredient::find($ingredient->id);
        if(!$ingredient){
            $status = 404;
            $msg = 'Zutat nicht gefunden.';
        }
        else{
            $ingredient->delete();
            $status = 200;
            $msg = 'Zutat '.$ingredient->title.' wurde erfolgreich gelöscht.';
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

        return redirect()->route('ingredient.index')->with('success', $msg);
    }

    public function lock(Request $request, Ingredient $ingredient){
        $ingredient = Ingredient::find($ingredient->id);
        $ingredient->lockedIngredients()->toggle(auth()->user()->id);

        return redirect()->route('ingredient.index');
    }
}
