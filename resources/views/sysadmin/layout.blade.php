<!DOCTYPE html>
<html lang="en" ng-app="promocaoApp">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('public.title') }} sysadmin</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
        rel="stylesheet">
  @yield('styles')

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

{{-- Navigation Bar --}}
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed"
              data-toggle="collapse" data-target="#navbar-menu">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ config('public.title') }} sysadmin</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-menu">
      @include('sysadmin.partials.navbar')
    </div>
  </div>
</nav>

@yield('content')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


<script src="{{ asset('assets/plugins/mask/src/jquery.mask.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>


       
<script src="{{ asset('/assets/js/angular.min.js') }}"></script> 
<script src="{{ asset('/assets/js/mundo-premiado-admin.js') }}"></script>

<link href="{{ asset('assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/css/mundo-premiado-admin.css') }}" rel="stylesheet">

@yield('scripts')


</body>
</html>