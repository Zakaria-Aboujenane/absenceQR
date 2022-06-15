@extends('layouts.admin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Séances</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matiére</th>
                        <th>Filiere</th>
                        <th>Professeur </th>
                        <th>date</th>
                        <th>Heure </th>
                        <th>Salle </th>
                        <th>Active</th>
                        <th>Passé</th>
                        <th style="width: 170px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($seance as $snc)
                        <tr>
                            <td>{{$snc->id}}</td>
                            <td>{{$snc->matiere}}</td>
                            <td>{{$snc->filiere->intitule}}</td>
                            <td>{{$snc->Prof->name}}</td>
                            <td>{{$snc->date_debut}}</td>
                            <td>{{$snc->heure_debut}}</td>
                            <td>{{$snc->ref_salle}}</td>
                            <td>@if($snc->active==0) No active @elseif($snc->active==1) Active @endif</td>
                            <td>@if($snc->seance_passe==0) No passé @elseif($snc->seance_passe==1) passé @endif</td>
                            <td>
                                <center>
                                    @if($snc->seance_passe==1)
                                    <a class="btn btn-info" class="graph" href="{{url('/etudiants_par_seance/'.$snc->id)}}"><i class="fa fa-list-ul"></i></a>
                                    @endif
                                    <a class="btn btn-warning" class="graph" href="{{url('/ModifySeance/'.$snc->id)}}"><i class="fa fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger" class="graph" href="{{url('/DeleteSeance/'.$snc->id)}}"><i class="fa fa-trash-alt"></i></a>
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
