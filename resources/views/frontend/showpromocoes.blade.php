@extends('frontend.layout')

@section('title',  $promocao->titulo." - " )
@section('description',  "" )

@section('social-image',  asset($promocao->imagem))
@section('social-title',  $promocao->titulo)
@section('social-url',  $promocao->getPermaLink())

@section('content')

  <div class="container">

      <h1 class="titulo"><a href="{{ $promocao->getPermaLink() }}" title="{{ $promocao->titulo }}">{{ $promocao->titulo }}</a> </h1>
      <div class="row">
      
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
        	<div class="box-img">
         		<img alt="{{ $promocao->titulo }}" src="{{  asset($promocao->imagem) }}" class="img-responsive">
         	</div>
         	<div class="box-btn">
         		<? if(!empty($promocao->url_regulamento)): ?>
					<a class="btn btn-regulamento" rel="nofollow" target="_blank"href="{{ $promocao->url_regulamento }}" title="Saiba mais sobre a promoção {{ $promocao->titulo }}">Leia o regulamento</a>
				<? endif; ?>

				<? if(!empty($promocao->url_hotsite)): ?>
	  				<a class="btn btn-participe" rel="nofollow"  target="_blank" href="{{ $promocao->url_hotsite }}" title="Saiba mais sobre a promoção {{ $promocao->titulo }}">Participe</a>
	  			<? endif?>
	  		</div>

	  		<div class="mais-promocoes">
	  			<h2>Outras promoções</h2>
	  			<? foreach($outraspromocoes as $outrapromocao): ?>
	  				<h3><a href="<?=$outrapromocao->getPermaLink() ?>" title="<?=$outrapromocao->titulo?>"><?=$outrapromocao->titulo?> </a></h3>

	  			<? endforeach; ?>
	  		</div>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
	    	<div class="redes-sociais-promocao">
	    		<span class="info">Compartilhe essa promoção</span> <div class="addthis_sharing_toolbox" data-url="{{ $promocao->getPermaLink()  }}" data-title="<?=$promocao->titulo?>"></div>
	    	</div>

            @include('frontend.partials.promocao-info')	
			
			<div class="descricao">
        	{!!  add_nofollow_content($promocao->descricao) !!}
        	</div>
        		<? 
         // $promocoes = Promocoes::
         //    selectRaw("DATEDIFF(periodo_fim, NOW()) as date_diff, sorteios.id, sorteios.periodo_inicio,sorteios.periodo_fim,sorteios.data_sorteio,sorteios.prom_id,sorteios.observacao,promocoes.* ")
         // ->join('sorteios', 'sorteios.prom_id', '=', 'promocoes.id')
         // ->groupBy("promocoes.id")
         // ->orderBy(DB::raw(" (case when date_diff < 0 then 1 else 0 end), abs(date_diff) "),'asc')
         // ->paginate(15);

        		$sorteios = $promocao->sorteios()->selectRaw("DATEDIFF(periodo_fim, NOW()) as date_diff, id, periodo_inicio,periodo_fim,data_sorteio,prom_id,observacao ")->orderBy(DB::raw(" (case when date_diff < 0 then 1 else 0 end), abs(date_diff) "),"asc")->get();

	        	 $x=0;if(!empty($sorteios) and count($sorteios) > 0):  ?>
					<div class="tabela-premios">
						<h2>Tabela de sorteios e prêmios</h2>
						
						<? foreach($sorteios as $sorteio): $x++;  ?>
							<div class="sorteio"><?=$x;?>. Período entre <a href="#"><?=DateYMDforBR($sorteio->periodo_inicio);?></a> e <a href="#"><?=DateYMDforBR($sorteio->periodo_fim)?></a> - Sorteio: <a href="#"><?=DateYMDforBR($sorteio->data_sorteio)?></a>
								<?if($sorteio->periodo_fim >= date('Ymd')):?>

									<a rel="nofollow" target="_blank" href="{{ $promocao->url_hotsite }}" title="Lista de ganhadores" class="btn btn-participe">Participar</a>
								<?else:?>

									<a rel="nofollow" target="_blank" href="{{ $promocao->getUrlGanhadores() }}" title="Lista de ganhadores" class="btn btn-participe">Lista de ganhadores</a>
								<?endif?>
							</div>
							<table>
								<thead>
									<tr>
										<th class="quantidade">Contemplados 	<?= $sorteio->data ?></th>
										<th class="nome">Descrição</td>
										<th class="valor">Valor (unit)</th>
									</tr>
								</thead>
								<? foreach($sorteio->premios()->get() as $premio): ?>
								<tr>
									<td class="quantidade"><?=$premio->quantidade?></td>
									<td class="nome"><?=$premio->nome?></td>
									<td class="valor">R$ <?=DecimalForReal($premio->valor)?></td>
								</tr>
								<? endforeach?>
							</table>
						<? endforeach; ?>


						<h3>Total em prêmios: R$ <?php echo DecimalForReal($promocao->getTotalPremiacao()); ?></h3>

						<!-- <span class="observacao">* Valor simbólico. O valor não fornecido no regulamento oficial da promoção.</span> -->
					</div>
		        <? endif?>
		    
		    <div class="nota">
		    	NOTA: Todos os dados acima foram coletados do regulamento oficial da promoção com a proposta de lhe apresentar em uma forma mais simples e objetiva. Essas informações podem estar desatualizadas ou sujeitas a erros. Não deixe de ler o regulamento oficial da promoção antes de qualquer ação. Caso encontre alguma inconformidade <strong><a href="{{ URL::to('fale-conosco') }}" title="Fale Conosco">entre em contato conosco</a></strong>. 
		    </div>


		    <div class="navegacao">
		    	<div class="anterior">
					<? if(is_object($previous)):?>
				    	<a class = "btn btn-participe" href="{{ $previous->getPermaLink() }}" title="{{ $previous->titulo }}">anterior</a>
					<? endif ?>
				</div>
				<div class="proximo">
				    <? if(is_object($next)):?>
				    	<a class = "btn btn-participe" href="{{ $next->getPermaLink() }}" title="{{ $next->titulo }}">próxima</a>
					<? endif?>
				</div>
			</div>
			


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