@extends('frontend.layout')

@section('title', "Promoções, Sorteios e Prêmios - " )
@section('description',  "Portal de promoções diversas (promoções, sorteios,premiações, brindes,produtos/serviços/ações promocionais)." )

@section('content')

  <div class="container">

    <hr>
    @if (session('message'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('message') }}
      </div>
    @endif    
  
    @foreach ($promocoes as $promocao)
      <div class="box-promocao">
        <div class="row">
        
          <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <h2><a href="{{ $promocao->getPermaLink() }}" title="{{ $promocao->titulo }}"><img class="img-responsive" alt="{{ $promocao->titulo }}" src="{{ asset($promocao->imagem) }}"></a></h2>
          </div>
          <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <div class="box-promocao-titulo">
              <a href="{{ $promocao->getPermaLink()  }}" title="{{ $promocao->getPermaLink()  }}">{{ $promocao->titulo }} {{ $promocao->date_diff }}</a>

              <div class="addthis_sharing_toolbox" data-url="{{ $promocao->getPermaLink()  }}" data-title="{{ $promocao->titulo }}" data-description=""></div>
            </div>

            @include('frontend.partials.promocao-info')


            <?=$promocao->premiacao ?>

            <div class="btn-vermais">
              <a class="btn" href="{{ $promocao->getPermaLink()  }}" title="Saiba mais sobre a promoção {{ $promocao->titulo }}">Mais detalhes <?=$promocao->ordem?></a>
            </div>
          </div>
        </div>
      </div>

    @endforeach

    <div class="paginacao">
      {!! $promocoes->render() !!}
    </div>
  </div>
@stop