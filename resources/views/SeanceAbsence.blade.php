@extends('layouts.admin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Séance {{\App\Models\Seance::Find($seance_id)->matiere}} / {{\App\Models\Seance::Find($seance_id)->date_debut}}</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom et Prénom</th>
                        <th>CNE</th>
                        <th>Email parent</th>
                        <th>Seance</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($listSeance as $etd)
                       
                        <tr>
                            <td>{{$etd["id_etudiant"]}} </td>
                            <td>{{$etd["name"]}}</td>
                            <td>{{$etd["CNE"]}}</td>
                            <td>{{$etd["email_parent"]}}</td>
                            <?php $s = \App\Models\Seance::Find($seance_id); ?>
                            <td>{{$s["matiere"]}}</td>
                            <td>{{$s['date_debut']}}</td>
                            <td>{{$etd["statusAbsence"]}}</td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
