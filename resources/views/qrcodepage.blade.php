@extends('layouts.prof')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Séances</h1>
    </div>

  <div id="qrCodePlace" > {{ $qrcode }} </div>

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
    }, 20000);
</script>

@endsection

