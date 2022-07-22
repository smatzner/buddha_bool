@extends('layouts.main')

@section('pageTitle','Einstellungen')

@section('content')

<h5 class="m-3"><strong> Deine persönlichen Zutaten:</strong></h5>

<div class="center-content">
  <table class="table w-75 mx-auto table-settings">
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

<h5 class="m-3"><strong>Deine Einstellungen:</strong></h5>

<div class="ms-5">
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
    <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
    <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" checked disabled>
    <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
  </div>
</div>

<h5 class="m-3"><strong>Deine gespeicherten Rezepte:</strong></h5>
    

@endsection