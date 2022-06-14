@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Modifier Une Seance</h1>
</div>

<form method="post" action="{{url('/ModifierSeance'.$seance->id)}}">
    {{ csrf_field() }}
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Intitule</label>
            <div class="col-sm-4">
                <input type="text"  class="form-control" id="name"  name="name" value="{{ $seance->matiere }}" required>
            </div>
            <label for="filier" class="col-sm-2 col-form-label">Filiere</label>
            <div class="col-sm-4">
                <select required name="filier" id="filier" class="form-control">
                    @foreach($filiers as $flr)
                        <option value="{{$flr->id}}" @if($flr->id==$seance->filiere_id) selected @endif>{{$flr->intitule}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="prof" class="col-sm-2 col-form-label">Prof</label>
            <div class="col-sm-4">
                <select required name="prof" id="prof" class="form-control">
                    @foreach($profs as $prf)
                        <option value="{{$prf->id}}" @if($prf->id==$seance->prof_id) selected @endif>{{$prf->name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="salle" class="col-sm-2 col-form-label">Salle</label>
            <div class="col-sm-4">
                <input type="text"  class="form-control" id="salle"  name="salle" value="{{ $seance->ref_salle }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-4">
                <input type="date"  class="form-control" id="date"  name="date"  value="{{ $seance->date_debut }}" required>
            </div>
            <label for="heure" class="col-sm-2 col-form-label">Heure</label>
            <div class="col-sm-4">
                <input type="time"  class="form-control" id="heure"  name="heure" value="{{ $seance->heure_debut }}"  required>
            </div>
        </div>
    
    <div class="btn-group float-right  col-sm-2" >
        <button type="submit" class="btn btn-primary btn-user float-right">
            <i class="fa fa-check"></i>
        </button>
    </div>
</form>


@endsection