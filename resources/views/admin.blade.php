@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Accueil</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">étudaiants présents</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$etudiants_presents}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-check fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">étudaiants absents</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$etudiants_absents}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pourcentage de présence</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$pourcentage_presence}}%</div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: {{$pourcentage_presence}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-percent fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Filieres</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nbrFils}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-number fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->

    <div class="row">

      <!-- Bar Chart -->
      <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">statistiques de presence selon la filiere</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" >
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Type de données:</div>
                <a class="dropdown-item" href="#">Ce Jour</a>
                <a class="dropdown-item" href="#">Ce Mois</a>
                <a class="dropdown-item" href="#">Ce Semester</a>
                <a class="dropdown-item" href="#">Cette Année</a>
              </div>
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-bar">
              <canvas id="myBarChart1"></canvas>
            </div>
          </div>
        </div>
      </div>


    <!-- Content Row -->
    <div class="row">
                <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Séances</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Séances pour tous les filieres</h6>
            </div>
            <div class="col-xl-12 col-lg-7">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matiére</th>
                        <th>Filiere</th>
                        <th>Professeur </th>
                        <th>date</th>
                        <th>Heure </th>
                        <th>Salle </th>
                        <th>Active</th>
                        <th>Passé</th>
                        <th style="width: 170px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($seance as $snc)
                        <tr>
                            <td>{{$snc->id}}</td>
                            <td>{{$snc->matiere}}</td>
                            <td>{{$snc->filiere->intitule}}</td>
                            <td>{{$snc->Prof->name}}</td>
                            <td>{{$snc->date_debut}}</td>
                            <td>{{$snc->heure_debut}}</td>
                            <td>{{$snc->ref_salle}}</td>
                            <td>@if($snc->active==0) No active @elseif($snc->active==1) Active @endif</td>
                            <td>@if($snc->seance_passe==0) No passé @elseif($snc->seance_passe==1) passé @endif</td>
                            <td>
                                <center>
                                    @if($snc->seance_passe==1)
                                    <a class="btn btn-info" class="graph" href="{{url('/ShowAbsence/'.$snc->id)}}"><i class="fa fa-list-ul"></i></a>
                                    @endif
                                    <a class="btn btn-warning" class="graph" href="{{url('/ModifySeance/'.$snc->id)}}"><i class="fa fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger" class="graph" href="{{url('/DeleteSeance/'.$snc->id)}}"><i class="fa fa-trash-alt"></i></a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      <?php
        $arry = [19,12];
      ?>





    </div>
    @endsection
@section('content2')
    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Set new default font family and font color to mimic Bootstrap's default styling


        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Bar Chart Example


        var ctx = document.getElementById("myBarChart1");
        var myBarChart1 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($filieres),
                datasets: [{
                    label: "totale",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data:@json($pourcentages),
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'references'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 80
                        },
                        maxBarThickness: 10,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max:100,
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return  number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ':' + number_format(tooltipItem.yLabel);
                        }
                    }
                },
            }
        });

    </script>

  <!-- /.container-fluid -->

<!-- End of Main Content -->

@endsection


