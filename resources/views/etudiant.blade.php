@extends('layouts.admin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Etudiants</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom et prénom</th>
                        <th>Email</th>
                        <th>Cin </th>
                        <th>Cne</th>
                        <th>Email parent </th>
                        <th>Filiere </th>
                        <th>Niveau</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiant as $etd)
                        <tr>
                            <td>{{$etd->id}}</td>
                            <td>{{$etd->name}}</td>
                            <td>{{$etd->email}}</td>
                            <td>{{$etd->cin}}</td>
                            <td>{{$etd->cne}}</td>
                            <td>{{$etd->email_parent}}</td>
                            <td>{{$etd->filiere->intitule}}</td>
                            <td>{{$etd->filiere->niveau}}</td>

                            <td>
                                <center>
                                    <a class="btn btn-info" class="graph" href="{{url('/seances_par_etudiant/'.$etd->id)}}"><i class="fa fa-list-ul"></i></a>
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
