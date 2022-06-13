@extends('layouts.auth')

@section('content')

    <h1>Prof page XD</h1>
    @isset($prof)
        <p>informations du prof {{ $prof }}</p>
        <p> nom : {{$prof->name}}</p>
    @else
    <p>no prof selected</p>
    @endisset
<h1>Lisr profs:</h1>

    <?php  $user=  Auth::guard('prof')->user();
            $seances = \App\Models\Seance::seancesDuProf($user->id)->get();


    ?>
    user:  {{  $user->name }}
    <ul>
    @foreach($seances as $s)
       <li><a href="{{URL::route('qr_code_page', [$s->id] )}}">{{$s->matiere}}</a></li>
    @endforeach
    </ul>



@endsection
