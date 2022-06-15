<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>




<h1>Lisr profs:</h1>

    <?php  $user=  Auth::guard('prof')->user();
            $seances = \App\Models\Seance::seancesDuProf($user->id)->get();


    ?>
    user:  {{  $user->name }}
    <ul>
    @foreach($seances as $s)
       <li><a href="{{URL::route('qr_code_page', [$s->id,$s->filiere_id] )}}">{{$s->matiere}}</a></li>
    @endforeach
    </ul>


</body>
</html>
