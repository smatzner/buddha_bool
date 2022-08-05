@extends('layouts.main')

@section('pageTitle','Benutzer')

@section('content')

 <h1>Alle Benutzer</h1>

 @if( session('success') )
 <div class="alert alert-success">{{ session('success') }}</div>
 @endif

  <table class="table table-hover table-settings">
    <thead>
      <tr>
        <th>#</th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E-Mail</th>
        <th class="text-center">Admin</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{$user->id}}</th>
        <th>{{$user->first_name}}</th>
        <th>{{$user->last_name}}</th> 
        <th>{{$user->email}}</th>
        <th class="text-center">@if ($user->is_admin) <i class="fa-solid fa-check"> @endif</th>
        <th><a href="{{route('user.edit',$user->id)}}" class="btn btn-outline-secondary">Bearbeiten</a></th>
        <th><a href="{{route('user.destroy',$user->id)}}" class="btn btn-outline-secondary">Löschen</a></th>
      </tr>
    @endforeach
  </table>

@endsection