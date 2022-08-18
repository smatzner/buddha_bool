<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        if($request->is_admin == "on"){
            $user->is_admin = 1;
        } else {
            $user->is_admin = 0;
        }

        $adminCount = User::where('is_admin', 1)->count();
        if($adminCount == 1 && $user->is_admin == 0){
            return redirect()->back()->with('error', 'Es muss mindestens ein Admin-Benutzer vorhanden sein!');
        }

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
            $user->delete();
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
