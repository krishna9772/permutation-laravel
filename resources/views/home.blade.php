<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Test</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <style type="text/css">
      .loading {
          z-index: 20;
          position: absolute;
          top: 0;
          left:-5px;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.4);
      }
      .loading-content {
          position: absolute;
          border: 16px solid #f3f3f3;
          border-top: 16px solid #3498db;
          border-radius: 50%;
          width: 50px;
          height: 50px;
          top: 40%;
          left:50%;
          animation: spin 2s linear infinite;
          }
            
          @keyframes spin {
              0% { transform: rotate(0deg); }
              100% { transform: rotate(360deg); }
          }

          #btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
          }
  </style>


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark m-2 p-3 rounded">  
        <a class="navbar-brand text-white" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active text-white" href="{{route('home')}}">Home</a>
          </div>
        </div>
      </nav>
    <div class="container-fluid mt-5">
        <section id="loading" class="loading">
             <div id="loading-content" class="loading-content"></div>
        </section>
        {{-- Change views with the result --}}
        @if(\Request::route()->getName() != 'home') 
          <div class="d-flex justify-content-end">
              <h6 class="p-2">HIER + GIBT + ES = NEUES</h6>
              <h6 class="p-2">Iterations: {{ number_format($iterations) }}</h6>
              <h6 class="p-2">Seconds: {{ $seconds }}</h6>
          
          </div>
        @else
          <form action="{{route('action','action')}}" method="GET">
            <div class="d-flex justify-content-center">
              <h6 class="p-2">HIER + GIBT + ES = NEUES</h6>              
              <button class="btn btn-secondary"> Find Solution </button>
            </div>
          </form>
        @endif

        <div class="row">
                @if(isset($solutions) && $solutions != ' ')
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
                                    <small>No. {{$key + 1}}</small>
                                  </h6>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>

                  
                  @endforeach
                @endif
               

        </div>
    </div>
    <button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top"
        >
      <i class="fas fa-arrow-up"></i>
    </button>
</body>
<script>

  
//Get the button
let mybutton = document.getElementById("btn-back-to-top");


$(document).ready(function(){

  $('#loading').removeClass('loading');
  $('#loading-content').removeClass('loading-content');

})

$(function() {
    $( "form" ).submit(function() {
      $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    });
});

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

</script>
</html>