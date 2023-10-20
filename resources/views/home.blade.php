<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Test</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark m-2 p-3 rounded">  
        <a class="navbar-brand text-white" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active text-white" href="#">Home</a>
          </div>
        </div>
      </nav>
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <h6 class="p-2">HIER + GIBT + ES = NEUES</h6>
            <h6 class="p-2">Iterations: {{ number_format($iterations) }}</h6>
            <h6 class="p-2">Seconds: {{ $seconds }}</h6>

        </div>
        <div class="row">
                @foreach($solutions as $key => $solution)
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-body">
                 
                            <p class="card-text">
                                <?php

                                  echo "HIER = ".$solution['HIER'].", GIBT = ".$solution['GIBT'].", "." ES = ". $solution['ES'].", NEUES = ".$solution['NEUES']."<hr>";
                                  foreach (str_split("HIERGBTSNU") as $index => $letter) {
                                      echo "$letter: " .  explode(',',$solution['PERM'])[$index]  ."<br>"; 
                                      // Assing the letters to digits
                                  }
                                  echo "<br>";
                                ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                              <h6 class="p-2">
                                {{$solution['HIER']. " + ". $solution['GIBT']. " + ". $solution['ES']." = ".$solution['NEUES']}}
                              </h6>
                              <h6 class="p-2">
                                <muted>No. </muted><small>{{$key + 1}}</small>
                              </h6>
                            </div>
                        </div>
                    </div>
                    <br/>
                </div>

                
                @endforeach

        </div>
    </div>
</body>
</html>