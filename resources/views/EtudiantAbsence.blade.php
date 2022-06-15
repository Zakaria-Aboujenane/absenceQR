@extends('layouts.admin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Etudiant {{$etudiantname}}</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Matiere</th>
                        <th>Professeur</th>
                        <th>Email parent</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($listSeance as $snc)
                        <tr>
                            <td>{{$snc['matiere']}}</td>
                            <td>{{$snc['prof']}}</td>
                            <td>{{$snc['email_parent']}}</td>
                            <td>{{$snc['date']}}</td>
                            <td>{{$snc['statusPres']}}</td>
                            <td>
                                <center>
                                    @if($snc['statusPres']=='absent')
                                    <a class="btn btn-info" class="graph" href="{{url("/testmail/".$snc['idseance']."/".$etudiantid)}}"><i class="fa fa-envelope"></i></a>
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
