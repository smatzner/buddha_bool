<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $ingredients = Ingredient::with('category:id,title')->where('user_id',$id)->get();
        return view('user.show',compact('user','ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $users = User::all();
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email:filter,dns',
        ]);

        $adminCount = User::where('is_admin', 1)->count();
        if($user->is_admin && $adminCount == 1 && !$request->has('is_admin')) {
            return redirect()->back()->with('error', 'Es muss mindestens ein Admin-Benutzer vorhanden sein.');
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->is_admin = $request->has('is_admin');
        $user->save();

        $user->update($request->all());
        return redirect()->route('user.index')->with('success', 'Benutzer '.$request->email.' wurde erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            $status = 404;
            $msg = 'Benutzer nicht gefunden';
        }
        elseif($user->is_admin == 1){
            $status = 403;
            $msg = 'Admin Benutzer können nicht gelöscht werden';
        }
        else{
            // $user->delete(); // TODO: aktivieren
            $status = 200;
            $msg = 'Benutzer '.$user->email.' wurde erfolgreich gelöscht';
        }

        //Aufruf per JavaScript
        if( request()->ajax() ){
            return response()->json(['status'=>$status,'msg'=>$msg],$status);
        }

        //Aufruf per HTML
        if( $status == 404 ){
            abort(404);
        }

        return redirect()->route('user.index')->with('success', $msg);
    }
}
