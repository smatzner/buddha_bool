<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        
        return view('settings.index',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email:filter,dns',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->veg = $request->has('veg');
        $user->vgn = $request->has('vgn');
        $user->gf = $request->has('gf');
        $user->save();

        return redirect()->back()->with('success', 'Einstellungen erfolgreich geändert.');
    }
}
