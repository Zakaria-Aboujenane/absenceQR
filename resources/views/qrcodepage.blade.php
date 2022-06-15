<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>qrcode page</title>
</head>
<body>
  <div id="qrCodePlace" > {{ $qrcode }} </div>
<button id="reloadBtn" > reload QR code </button>

  <form action="/fin_seance" method="GET">
      <input type="hidden" name="id_seance" value="{{$id_Seance}}">
      <input type="hidden" name="id_filiere" value="{{$id_filiere}}">
      <button type="submit">Declarer le debut de seance (fin de marquage d'absence)</button>
  </form>

<script>
    function qr_code_generation() {
        $.ajax({
            url: "/ajax-request",
            type:"GET",
            data:{
            },
            success:function(response){
                $('#qrCodePlace').html(response);

            },
            error: function(error) {
                // console.log(error);
                $('#qrCodePlace').html('<h1>Qr Code error</h1>')
            }
        });
    }
    $("#reloadBtn").click(function(event){
        qr_code_generation();




    });
    var intervalId = window.setInterval(function(){
        /// call your function here
        qr_code_generation();
    }, 5000);
</script>

</body>
</html>
