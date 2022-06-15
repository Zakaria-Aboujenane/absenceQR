@extends('layouts.prof')
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Scanner le QR CODE</h1>
    </div>
    <div class="card shadow mb-4">
    <div class="card-body">
        <center><div id="qrCodePlace" > {{ $qrcode }} </div></center>

        <form action="/fin_seance" method="GET">
            <input type="hidden" name="id_seance" value="{{$id_Seance}}">
            <input type="hidden" name="id_filiere" value="{{$id_filiere}}">
            <button type="submit" class="btn btn-primary btn-user float-right">Fin de marquage d'absence</button>
        </form>
    </div>
    </div>

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

