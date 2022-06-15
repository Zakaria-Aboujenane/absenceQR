@extends('layouts.prof')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Séances</h1>
</div>
<?php
$user =Auth::guard('prof')->user();
$seances = \App\Models\Seance::seancesDuProf($user->id)->get();
?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matiére</th>
                        <th>Filiere</th>
                        <th>date</th>
                        <th>Heure </th>
                        <th>Salle </th>
                        <th style="width: 170px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($seances as $snc)
                        <tr>
                            <td>{{$snc->id}}</td>
                            <td>{{$snc->matiere}}</td>
                            <td>{{$snc->filiere->intitule}}</td>
                            <td>{{$snc->date_debut}}</td>
                            <td>{{$snc->heure_debut}}</td>
                            <td>{{$snc->ref_salle}}</td>
                            <td>
                                <center>
                                    @if($snc->seance_passe==0)
                                    <a class="btn btn-info" class="graph" href="{{URL::route('qr_code_page', [$snc->id,$snc->filiere_id] )}}"><i class="fa fa-qrcode-ul"></i></a>
                                    @endif
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


