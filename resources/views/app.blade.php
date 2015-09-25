<html>
<head>
    <title>
        Quadraxis Deployment Engine
    </title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/3191a51e-f633-4055-bc02-a9b82577a2bc.css"/>
    <link href="{{ asset('/css/site.css') }}" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Quadraxis</a>
    <ul class="nav navbar-nav">
    <li><a href="{{ url('/images') }}">Available AMIs</a></li>
    <li><a href="{{ url('/deployments') }}">Deployments</a></li>
    </ul>
  </div>
</nav>

    @yield('content')

    <script src="{{ asset('/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

</body>
</html>