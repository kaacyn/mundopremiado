<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


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
  <link rel="alternate" href="http://mundopremiado.com.br" hreflang="pt-br" /> 
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('assets/favicon') }}/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <title>@yield('title') Mundo Premiado</title>
  <meta name="description" content="@yield('description')">



  <meta name="keywords" content="concursos culturais, sorteios, promoções, premiações">
  <meta property="og:image:width" content="456"/>
  <meta property="og:image:height" content="240"/>
  <meta property="og:url" content="@yield('social-url')"/>
  <meta property="og:title" content="@yield('social-title')"/>
  <meta property="og:image" content="@yield('social-image')" />
</head>
<body class="{{{ bodyClass() }}}">

  <header>
    <div class="container">
      <div class="row">
      
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
          <a href="<?=url('/') ?>" class="imagem_logo" title="Mundo Premiado"><img src="{{ asset('/assets/frontend/dist/images/mascote.jpg') }}" alt="Mundo Premiado"></a>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
          <div class="logo">
            <a href="<?=url('/') ?>" class="nome" title="Mundo Premiado">Mundo Premiado</a>
            <!--  <h2>Prêmios sem limites</h2> -->
            <a href="<?=url('/') ?>" class="slogan" title="Mundo Premiado">Um mundo de prêmios para você</a>
          </div>
        </div>
      </div>
    </div>

    <section class="menu">
      <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <ul>
                  <li><a href="{{ URL::to('/') }}" title="Página principal">Página principal</a></li>
                  <li><a href="{{ URL::to('envie-sua-promocao') }}" title="Envie sua prmoção">Envie sua promoção</a></li>
                  <li><a href="{{ URL::to('fale-conosco') }}" title="Fale Conosco">Fale Conosco</a></li>
                </ul>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 hidden-xs hidden-sm">
                <ul class="redes-sociais">
                  <li><a href="https://twitter.com/mundopremiado" target="_blank" title="Acesse nosso twitter"><img src="{{ asset('/assets/frontend/dist/images/twitter_square-48.png') }}"></a></li>
                  <li><a href="https://www.facebook.com/mundopremiado/" target="_blank" title="Acesse nossa página no facebook"><img src="{{ asset('/assets/frontend/dist/images/facebook_square-48.png') }}"></a></li>
                  <li><a href="{{ URL::to('fale-conosco') }}" title="Fale Conosco"><img src="{{ asset('/assets/frontend/dist/images/email.png') }}"></a></li>
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
    
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <ul>
          <li><a href="{{ URL::to('fale-conosco') }}" title="Fale conosco">Fale conosco</a></li>
          <li><a href="{{ URL::to('sobre') }}" title="Sobre o Mundo Premiado">Sobre o Mundo Premiado</a></li>
          <li><a href="{{ URL::to('politica-de-privacidade') }}" title="Política de Privacidade">Política de Privacidade</a></li>
        </ul>
      </div>

      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 hidden-xs hidden-sm">

        <div class="fb-page" data-href="https://www.facebook.com/mundopremiado/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/mundopremiado/"><a href="https://www.facebook.com/mundopremiado/">Mundo Premiado</a></blockquote></div></div>

      </div>

    </div>


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

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-70681969-1', 'auto');
    ga('send', 'pageview');

  </script>


  <link href="{{ asset('assets/frontend/dist/styles/main.min.css') }}" rel="stylesheet">

  <script src="{{ asset('assets/frontend/dist/scripts/main.min.js') }}"></script>  

</body>
</html>