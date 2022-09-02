<?php

namespace App\Http\Controllers;

use App\Models\Index;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        $salad = Ingredient::where('category_id',1)->get();
        $vegetable = Ingredient::where('category_id',2)->get();
        $carb = Arr::random(Ingredient::where('category_id',3)->get()->toArray());
        $protein = Ingredient::where('category_id',4)->get();
        $fat = Ingredient::where('category_id',5)->get();
        $fruits = Ingredient::where('category_id',6)->get();
        $topping = Ingredient::where('category_id',7)->get();
        return view('index',compact('ingredients','carb'));
    }

    public function generate(Request $request)
    {
        // dd($request);
        return redirect()->route('index');
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
}
