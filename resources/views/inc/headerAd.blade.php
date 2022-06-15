<!DOCTYPE html>
<html>
<head>
  <title>STOCK</title>
  <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/style.css')}}">
  <script type="text/javascript" src="{{ url('js/jquery-3.1.0.js')}}"></script>
  <script type="text/javascript" src="{{ url('js/bootstrap.js')}}"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="{{ url('/homeAd') }}">Pharmacy Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/stockAd') }}">Stock <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/addstockAd') }}">New Create</a>
      </li>
    </ul>
    
  </div>
</nav>

</body>
</html>