@extends('layouts.main')

@section('pageTitle','Benutzer ändern')

@section('content')
    <h1>Benutzer {{$user->email}} ändern</h1>
    <div class="button"><a href="{{route('user.index')}}" class="btn btn-outline-secondary">Alle Benutzer</a></div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div id="form" class="form">
        <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group mb-2">
                <label for="first_name">Vorname</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{old('first_name',$user->first_name)}}" required>
            </div>
            @error('first_name')
                <div class="invalid-feedback show-block">{{$message}}</div>w
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
                <label class="form-check-label" for="flexSwitchCheckReverse">Admin</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($user->is_admin) checked @endif name="is_admin">
            </div>

            <button type="submit" class="btn btn-dark">Speichern</button>
            {{-- TODO: Passworteingabe bei Admin-Änderung --}}
            {{-- TODO: Modal Fenster um Änderung zu bestätigen - notwendig? --}}
        </form>
    </div>

@endsection