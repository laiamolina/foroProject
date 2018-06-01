<?php require 'views/partials/header.php'; ?>
<?php  
$v1=$_GET['id'];
?>

<body ng-app="myApp" ng-controller="myCtrl">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">LMDB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Pel·lícules <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Nose</a>
      </li>
    </ul>
    <a href="/login" class="btn btn-warning  navright"> 
        <i class="fas fa-user"></i>
    </a>
  </div>
</nav>

<form class="form-inline my-4 my-lg-0">
<input class="form-control mr-sm-4 cercador" type="search"  placeholder="Cerca" ng-change="cerca(nom)" ng-model="nom" aria-label="Search">   
</form>

<div class="container-fluid">
    <br>
    <div class="pare">
        <div class="fill mx-auto" style="background-image: url(https://image.tmdb.org/t/p/w500{{movie.backdrop_path}}); background-repeat: no-repeat; background-size: cover;">
            <div class="fill fill1 mx-auto" style="background-image: radial-gradient(circle at -2% 45%, rgba(239, 124, 6, 0.81) 0%, rgba(152, 26, 26, 0.88) 100%)">
            <div class="row margin">
                    <div class="col-md-5 col-xs-12 center">
                         <img class="img-fluid mt-5 img-info" src="https://image.tmdb.org/t/p/w300/{{movie.poster_path}}">
                    <div class="row center">
                        <div class="col-md-4 mt-3 margin">
                        <a target="_blank" href="https://www.youtube.com/watch?v={{trailer}}"><i class="fas fa-play-circle play"></i></a>

                        </div>
            </div>
                    </div>
                    <div class="col-md-6 col-xs-6 mr-auto">
                        <h1 class="mt-5 text-white">{{movie.title}}
                        <span class="data">({{movie.release_date.substr(0,4)}})</h1>
                        <hr style="background-color:darkred;">
                        <p class="text-white genre"> Género: 
                        <span class="genres" ng-repeat="genre in movie.genres">{{genre.name}}, </span></p>
                        <p class="text-white genre">Duración: 
                        <span class="genres">{{movie.runtime}} min</p>
                        <h5 class="text-white genre">Sinopsis</h5>
                        <p class="text-white">{{movie.overview}}</p>
                            
                    </div>    
            </div>
        </div>

    </div>
</div>


<?php require 'views/partials/footer.php'; ?>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');
    $scope.trailer='';
    $scope.fetch_trailer_url = `https://api.themoviedb.org/3/movie/${id}/videos?api_key=1c104b303dc877c992ec8975a7ccb2e5&language=es-ES`;
    $scope.url = `https://api.themoviedb.org/3/movie/${id}}?api_key=1c104b303dc877c992ec8975a7ccb2e5&language=es-ES`;
    $scope.actor=`https://api.themoviedb.org/3/movie/${id}/person?api_key=1c104b303dc877c992ec8975a7ccb2e5&language=es-ES`;

    $scope.person=``
    $scope.movie='';   
    $scope.video=''; 
  

    getMovies($scope.url).then((movie) => {
        $scope.movie = movie;
        console.log(movie);
        $scope.$apply();
    })

    getMovies($scope.fetch_trailer_url).then((trailer) =>{
        $scope.video=trailer;
        console.log(trailer);
        $scope.trailer=trailer.results[0].key;
        $scope.$apply();
    })

    getMovies($scope.fetch_trailer_url).then((actor) =>{
        $scope.actor=actor;
        console.log(actor);
        $scope.$apply();
    })

});
</script>
