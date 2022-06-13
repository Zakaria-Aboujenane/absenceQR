@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ajouter Une Seance</h1>
</div>

<form method="post" action="{{url('/AddSeances')}}">
    {{ csrf_field() }}
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Intitule</label>
            <div class="col-sm-4">
                <input type="text"  class="form-control" id="name" placeholder="Intitule" name="name" value="{{ old('name') }}" required>
            </div>
            <label for="nbr_ocr" class="col-sm-2 col-form-label">Nombre d'occurences</label>
            <div class="col-sm-4">
                <input type="number"  class="form-control" id="nbr_ocr" placeholder="Occurences" name="nbr_ocr" value="{{ old('nbr_ocr') }}" required>

            </div>
        </div>
        <div class="form-group row">
            <label for="filier" class="col-sm-2 col-form-label">Filiere</label>
            <div class="col-sm-4">
                <select required name="filier" id="filier" class="form-control">
                    @foreach($filiers as $flr)
                        <option value="{{$flr->id}}">{{$flr->intitule}}</option>
                    @endforeach
                </select>
            </div>
            <label for="prof" class="col-sm-2 col-form-label">Prof</label>
            <div class="col-sm-4">
                <select required name="prof" id="prof" class="form-control">
                    @foreach($profs as $prf)
                        <option value="{{$prf->id}}">{{$prf->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>
    
    
    <div class="btn-group float-right  col-sm-2" >
        <button type="submit" class="btn btn-primary btn-user float-right">
            <i class="fa fa-check"></i>
        </button>
    </div>
</form>


@endsection