@extends('frontend.layout')

@section('title',  $promocao->titulo." - " )
@section('description',  "" )
@section('imagem-social',  asset($promocao->imagem))

@section('content')

  <div class="container">

      <h1 class="titulo">{{ $promocao->titulo }} </h1>
      <div class="row">
      
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
         <img alt="{{ $promocao->titulo }}" src="{{  asset($promocao->imagem) }}" class="img-resposnsive">

         Data Início: {{ DateYMDforBR($promocao->data_inicio) }}<br>
         Data Fim: {{ DateYMDforBR($promocao->data_fim) }}<br>
         {{ $promocao->url_hotsite }}<br>
         {{ $promocao->url_regulamento }}<br>
         R$: {{ DecimalForReal($promocao->valor_premiacao) }}<br>
         R$: {{ DecimalForReal($promocao->valor_minimo) }}<br>
         {{ $promocao->regiao }}<br>
  


        </div>
        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
	    	<div class="redes-sociais-promocao">
	    		<span class="info">Compartilhe essa promoção</span> <div class="addthis_sharing_toolbox" data-url="{{ $promocao->getPermaLink()  }}" data-title="{{ $promocao->titulo }}" data-description=""></div>
	    	</div>

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