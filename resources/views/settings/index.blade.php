@extends('layouts.main')

@section('pageTitle','Einstellungen')

@section('content')

<h1>Einstellungen</h1>

@if( session('success') )
 <div class="alert alert-success">{{ session('success') }}</div>
 @endif


<div id="form" class="form">
    <form action="{{route('settings.update',$user->id)}}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label for="first_name">Vorname</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{old('first_name',$user->first_name)}}" required>
        </div>
        @error('first_name')
            <div class="invalid-feedback show-block">{{$message}}</div>
        @enderror
        <div class="form-group mb-2">
            <label for="last_name">Nachname</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{old('last_name',$user->last_name)}}">
        </div>
        @error('last_name')
            <div class="invalid-feedback show-block">{{$message}}</div>
        @enderror
        <div class="form-group mb-2">
            <label for="email">E-Mail</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email',$user->email)}}">
        </div>
        @error('email')
                <div class="invalid-feedback show-block">{{$message}}</div>
        @enderror
        <div class="form-check form-switch form-check-reverse">
            <label class="form-check-label" for="flexSwitchCheckReverse">Vegetarisch</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($user->veg) checked @endif name="veg">
        </div>
        <div class="form-check form-switch form-check-reverse">
            <label class="form-check-label" for="flexSwitchCheckReverse">Vegan</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($user->vgn) checked @endif name="vgn">
        </div>
        <div class="form-check form-switch form-check-reverse">
            <label class="form-check-label" for="flexSwitchCheckReverse">Glutenfrei</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($user->gf) checked @endif name="gf">
        </div>
        <button type="submit" class="btn btn-dark">Speichern</button>
    </form>
</div>

@endsection