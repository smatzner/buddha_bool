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
      <th></th>
    </tr>
  </thead>
  @foreach ($users as $user)
    <tr>
      <td scope="row">{{$user->id}}</td>
      <td>{{$user->first_name}}</td>
      <td>{{$user->last_name}}</td> 
      <td>{{$user->email}}</td>
      <td class="text-center">@if ($user->is_admin) <i class="fa-solid fa-check"> @endif</td>
      <td><a href="{{route('user.show',$user->id)}}" class="btn btn-outline-secondary">Anzeigen</a></td>
      <td><a href="{{route('user.edit',$user->id)}}" class="btn btn-outline-secondary">Bearbeiten</a></td>
      <td>
        <form action="{{route('user.destroy',$user->id)}}" method="POST" class="delete" data-title="{{$user->email}}" data-body="Wollen Sie den Benutzer <strong>{{$user->email}}</strong> löschen?" data-error="@if ($user->is_admin) Admin Benutzer können nicht gelöscht werden! @else Benutzer nicht gefunden! @endif">
          @method('DELETE')
          @csrf
          @if ($user->is_admin)
          <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Admins können nicht gelöscht werden! Bitte entfernen Sie zunächst die Adminrechte dieses Users, bevor Sie ihn löschen.">
          @endif
            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" @if($user->is_admin) disabled @endif>Löschen</button>
          @if ($user->is_admin)
          </span>
          @endif
        </form>
      </td>
    </tr>
  @endforeach
</table>


@endsection