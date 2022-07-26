@extends('layouts.main')

@section('pageTitle','Admin')

@section('content')

<div class="center-content">
    <table class="table mx-auto table-settings">
        <thead>
          <tr>
            <th scope="col">Kategorie</th>
            <th scope="col">Bezeichnung</th>
            <th scope="col">Energiegehalt</th>
            <th scope="col">Protein</th>
            <th scope="col">Kohlenhydrate</th>
            <th scope="col">Fett</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Protein</th>
            <td>Hühnerfilet</td>
            <td>200kcal</td>
            <td>30g</td>
            <td>20g</td>
            <td>15g</td>
            <td><button class="btn btn-sm btn-outline-secondary">ändern</button></td>
          </tr>
          <tr>
            <th scope="row">Salatbasis</th>
            <td>Blattspinat</td>
            <td>10kcal</td>
            <td>0g</td>
            <td>10g</td>
            <td>0g</td>
            <td><button class="btn btn-sm btn-outline-secondary">ändern</button></td>
          </tr>
          <tr>
            <th scope="row">Topping</th>
            <td>Hummus</td>
            <td>150kcal</td>
            <td>20g</td>
            <td>15g</td>
            <td>15g</td>
            <td><button class="btn btn-sm btn-outline-secondary">ändern</button></td>
          </tr>
        </tbody>
    </table>
  </div>

@endsection