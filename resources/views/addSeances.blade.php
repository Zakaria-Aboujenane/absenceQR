@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ajouter une Seance</h1>
</div>

<form method="post" action="{{url('/AddSeances/'.$name.'/'.$nbr_ocr.'/'.$prof.'/'.$filier)}}">
    {{ csrf_field() }}
    @for($i=0;$i<$nbr_ocr;$i++)
        <div class="form-group row">
            <label for="produit" class="col-sm-2 col-form-label">Seance {{$i+1}}</label>
            <label for="date" class="col-sm-1 col-form-label">Date</label>
            <div class="col-sm-3">
                <input type="date"  class="form-control" id="date" placeholder="Date" name="date_s{{$i}}"  required>
            </div>
            <label for="heure" class="col-sm-1 col-form-label">Heure</label>
            <div class="col-sm-2">
                <input type="time"  class="form-control" id="heure" placeholder="Heure" name="heure_s{{$i}}"  required>
            </div>
            <label for="salle" class="col-sm-1 col-form-label">Salle</label>
            <div class="col-sm-2">
                <input type="text"  class="form-control" id="sale" placeholder="Salle" name="salle_s{{$i}}"  required>
            </div>
        </div>
    @endfor

    <div class="btn-group float-right  col-sm-2" >
            <button type="submit" class="btn btn-primary btn-user float-right">
                <i class="fa fa-check"></i>
            </button>
    </div>
</form>
@endsection