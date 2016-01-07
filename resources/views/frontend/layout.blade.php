<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image" content="@yield('imagem-social')" />

  <!-- favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon') }}/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon') }}/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon') }}/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon') }}/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon') }}/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon') }}/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon') }}/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon') }}/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon') }}/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/favicon') }}/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon') }}/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon') }}/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon') }}/favicon-16x16.png">
  <link rel="manifest" href="{{ asset('assets/favicon') }}/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('assets/favicon') }}/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <title>@yield('title') Mundo Premiado</title>
  <meta name="description" content="@yield('description')">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
        rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/calculotributo.css">
  @yield('styles')

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="{{{ bodyClass() }}}">

  <header>
    <div class="container">
      <div class="row">
      
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
          <a href="<?=url('/') ?>" title="Mundo Premiado"><img src="{{ asset('/assets/images/mascote.jpg') }}" alt="Mundo Premiado"></a>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
          <div class="logo">
            <h1><a href="<?=url('/') ?>" title="Mundo Premiado">Mundo Premiado</a></h1>
            <!--  <h2>Prêmios sem limites</h2> -->
            <h2><a href="<?=url('/') ?>" title="Mundo Premiado">Um mundo de prêmios para você</a></h2>
          </div>
        </div>
      </div>
    </div>

    <section class="menu">
      <div class="container">
          <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <ul>
                  <li><a href="{{ URL::to('/') }}" title="Página principal">Página principal</a></li>
                  <li><a href="{{ URL::to('envie-sua-promocao') }}" title="Envie sua prmoção">Envie sua promoção</a></li>
                  <li><a href="{{ URL::to('fale-conosco') }}" title="Fale Conosco">Fale Conosco</a></li>
                </ul>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <ul class="redes-sociais">
                  <li><a href="https://twitter.com/mundopremiado" target="_blank" title="Acesse nosso twitter"><img src="{{ asset('/assets/images/twitter_square-48.png') }}"></a></li>
                  <li><a href="https://www.facebook.com/mundopremiado/" target="_blank" title="Acesse nossa página no facebook"><img src="{{ asset('/assets/images/facebook_square-48.png') }}"></a></li>
                  <li><a href="{{ URL::to('fale-conosco') }}" title="Fale Conosco"><img src="{{ asset('/assets/images/email.png') }}"></a></li>
                </ul>

            </div>
        </div>
      </div>
     </section>

     @include('frontend.partials.breadcrumb')

      @if (session('message'))
      <div class="notice">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="alert alert-info">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('message') }}
                </div>
            </div>
          </div>
        </div>
      </div>
      @endif 

  </header>

@yield('content')


<footer>
  <div class="container">

    <div class="row">
    
      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <ul>
          <li><a href="{{ URL::to('sobre') }}" title="Sobre o Mundo Premiado">Sobre o Mundo Premiado</a></li>
          <li><a href="{{ URL::to('fale-conosco') }}" title="Fale conosco">Fale conosco</a></li>
        </ul>
      </div>

      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

        <div class="fb-page" data-href="https://www.facebook.com/mundopremiado/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/mundopremiado/"><a href="https://www.facebook.com/mundopremiado/">Mundo Premiado</a></blockquote></div></div>

      </div>

    </div>


 
    <script
    src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script
    src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    

    <link href="{{ asset('assets/fonts/ubuntu/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/mundo-premiado.css') }}" rel="stylesheet">
            
    <script
    src="{{ asset('/assets/js/mundo-premiado.js') }}"></script>
    @yield('scripts')
  </div>
</footer>
<div class="container">
  © 2015/<?php echo date('Y'); ?> Mundo Premiado - Todos os direitos reservados
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=239133436106073";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-568bd75b4ea29ab9" async="async"></script>

</body>
</html>