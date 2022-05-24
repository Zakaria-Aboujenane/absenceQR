@extends('layouts.general')

@section('content')

    <ul>
        <li><h1>Authentification</h1></li>
        <li><a href="{{url('login/etudiant')}}">Espace etudiant</a></li>
        <li><a href="{{url('login/prof')}}">Espace prof</a></li>
        <li><a href="{{url('login/admin')}}">Espace Admin</a></li>
        <li><h1>Ajouter des elements</h1></li>
        <li><a href="{{url('register/etudiant')}}">Espace etudiant</a></li>
        <li><a href="{{url('register/prof')}}">Espace prof</a></li>
        <li><a href="{{url('register/admin')}}">Espace Admin</a></li>
    </ul>
@endsection
