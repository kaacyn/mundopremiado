@extends('frontend.layout')

@section('title',  $promocao->titulo." - " )
@section('description',  "" )

@section('social-image',  asset($promocao->imagem))
@section('social-title',  asset($promocao->titulo))
@section('social-url',  asset($promocao->getPermaLink()))

@section('content')

  <div class="container">

      <h1 class="titulo">{{ $promocao->titulo }} </h1>
      <div class="row">
      
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        	<div class="box-img">
         		<img alt="{{ $promocao->titulo }}" src="{{  asset($promocao->imagem) }}" class="img-responsive">
         	</div>
         	<div class="box-btn">
				<a class="btn btn-regulamento" target="_blank"href="{{ $promocao->url_regulamento }}" title="Saiba mais sobre a promoção {{ $promocao->titulo }}">Leia o regulamento</a>

	  			<a class="btn btn-participe" target="_blank" href="{{ $promocao->url_hotsite }}" title="Saiba mais sobre a promoção {{ $promocao->titulo }}">Participe</a>
	  		</div>

	  		<div class="mais-promocoes">
	  			<h2>Outras promoções</h2>
	  			<? foreach($outraspromocoes as $promocao): ?>
	  				<h3><a href="<?=$promocao->getPermaLink() ?>" title="<?=$promocao->titulo?>"><?=$promocao->titulo?></a></h3>

	  			<? endforeach; ?>
	  		</div>
        </div>
        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
	    	<div class="redes-sociais-promocao">
	    		<span class="info">Compartilhe essa promoção</span> <div class="addthis_sharing_toolbox" data-url="{{ $promocao->getPermaLink()  }}" data-title="{{ $promocao->titulo }}" data-description=""></div>
	    	</div>

            @include('frontend.partials.promocao-info')	
		
        	{!!  $promocao->descricao !!}


			<div id="disqus_thread"></div>
			<script>
			    /**
			     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
			     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
			     */
			    /*
			    var disqus_config = function () {
			        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
			        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			    };
			    */
			    (function() {  // DON'T EDIT BELOW THIS LINE
			        var d = document, s = d.createElement('script');
			        
			        s.src = '//mundopremiado.disqus.com/embed.js';
			        
			        s.setAttribute('data-timestamp', +new Date());
			        (d.head || d.body).appendChild(s);
			    })();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

        </div>
      </div>

  </div>
@stop