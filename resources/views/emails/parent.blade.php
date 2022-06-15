<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
</head>
<body>
<h2>Etudiant {{$etudiant->name}} Est Absent !</h2>
<h4> CNE : {{$etudiant->cne}}</h4>
<p>
    cher parents , votre fils c'est absente durant la seance de <span style="color:red"> {{$seance->matiere}} </span>
    dont la date est : <span style="color:green"> {{$seance->date_debut}} </span>
</p>
<p>{{ $test_message }}</p>
</body>
</html>
