@extends('layouts.admin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Professeurs</h1>
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
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($profs as $prf)
                        <tr>
                            <td>{{$prf->id}}</td>
                            <td>{{$prf->name}}</td>
                            <td>{{$prf->email}}</td>
                            <td>{{$prf->cin}}</td>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
