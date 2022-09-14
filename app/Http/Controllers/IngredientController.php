<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
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
            $ingredients = Ingredient::sortable()->with('category:id,title')->where('user_id',null)->orWhere('user_id',Auth::user()->id)->orderBy('user_id','desc')->get();
            // Add value 'count = 1' to categories with just one ingredient
            foreach($ingredients as $ingredient){
                if((Ingredient::where('category_id',$ingredient->category_id)->where('user_id',NULL)->count() == 1)){
                    $ingredient->count = 1;
                }
            }
        }
        else {
            $ingredients = Ingredient::sortable()->with('lockedIngredients')->with('category:id,title')->where('user_id',null)->orWhere('user_id',Auth::user()->id)->orderBy('user_id','desc')->get();
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
        if(!auth()->user()->is_admin || $request->has('personal')){
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
        if(auth()->user()->is_admin && !$ingredient->user_id){
            return view('ingredient.edit', compact('ingredient', 'categories'));
        }
        elseif(auth()->user()->id == $ingredient->user_id){
            return view('ingredient.edit', compact('ingredient', 'categories'));
        }
        else{
            abort(404);
        }
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

        
        $ingredientCount = Ingredient::where('category_id',$ingredient->category_id)->where('user_id',NULL)->count();

        $category = Category::select('id', 'title')->get();
        $userId = auth()->user()->id;

        $lockedIngredientCount = Ingredient::where('category_id',$ingredient->category_id)->whereHas('lockedIngredients',function($query) use ($userId) {$query->where('user_id',$userId);})->count();

        $allIngredientsCount = Ingredient::where('category_id',$ingredient->category_id)->where(function ($query) use ($userId){$query->where('user_id',NULL)->orWhere('user_id',$userId);})->count();



        if(auth()->user()->is_admin){
            if(($ingredientCount == 1) && ($request->input('category_id') != $ingredient->category_id*1 || $request->has('personal'))){ 
                return redirect()->back()->with('error', 'Es muss mindestens eine allgemeine Zutat in der Kategorie \''.$category[$ingredient->category_id-1]->title.'\' vorhanden sein!');
            }  
        }

        if(!auth()->user()->is_admin){
            if(($allIngredientsCount - $lockedIngredientCount == 1) && ($request->input('category_id') != $ingredient->category_id*1)){
                return redirect()->back()->with('error', 'Es muss mindestens eine Zutat in der Kategorie \''.$category[$ingredient->category_id-1]->title.'\' verfügbar sein! Entsperren Sie zunächst eine andere Zutat derselben Kategorie oder fügen Sie eine neue Zutat mit dieser Kategorie hinzu.');
            }
        }

        $ingredient->title = $request->title;
        $ingredient->category_id = $request->category_id;
        $ingredient->energy = $request->energy;
        $ingredient->protein = $request->protein;
        $ingredient->carbohydrate = $request->carbohydrate;
        $ingredient->fat = $request->fat;
        $ingredient->vgn = $request->has('vgn');
        $ingredient->veg = $request->has('veg');
        $ingredient->gf = $request->has('gf');
        if(auth()->user()->is_admin){
            if($request->has('personal')){
                $ingredient->user_id = auth()->user()->id;
            }
            else{
                $ingredient->user_id = NULL;
            }
        }
        $ingredient->save();
        
        return redirect()->route('ingredient.index')->with('success', 'Zutat '.$request->title.' wurde erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient // TODO: doc korrigieren
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredientCount = Ingredient::where('category_id',$ingredient->category_id)->where('user_id',NULL)->count();
    
 

        if(!$ingredient){
            $status = 404;
            $msg = 'Zutat nicht gefunden.';
        }
        elseif($ingredientCount == 1 && !$ingredient->user_id){
            $category = Category::select('id', 'title')->get();
            $status = 403;
            $msg = 'Es muss mindestens eine Zutat in der Kategorie \''.$category[$ingredient->category_id-1]->title.'\' vorhanden sein!';
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

    // TODO: doc
    public function lock(Request $request, Ingredient $ingredient){
        $category = Category::select('id', 'title')->get();
        $userId = auth()->user()->id;

        $lockedIngredientCount = Ingredient::where('category_id',$ingredient->category_id)->whereHas('lockedIngredients',function($query) use ($userId) {$query->where('user_id',$userId);})->count();

        $ingredientCount = Ingredient::where('category_id',$ingredient->category_id)->where(function ($query) use ($userId){$query->where('user_id',NULL)->orWhere('user_id',$userId);})->count();

        $isLocked = $ingredient->lockedIngredients()->pluck('id');

        if(($ingredientCount - $lockedIngredientCount == 1) && !isset($isLocked[0])){
            return redirect()->back()->with('error', 'Es muss mindestens eine Zutat in der Kategorie '.$category[$ingredient->category_id-1]->title.' verfügbar sein. Entsperren Sie zunächst eine andere Zutat derselben Kategorie oder fügen Sie eine neue Zutat mit dieser Kategorie hinzu.'); // FIXME: nicht schön
        }

        $ingredient->lockedIngredients()->toggle($userId);
        

        return redirect()->route('ingredient.index');
    }
}
