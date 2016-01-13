@extends('sysadmin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Promoções</h3>
          </div>
          <nav class="navbar navbar-inverse">
              <ul class="nav navbar-nav">
                  <li><a href="{{ URL::to('sysadmin/promocoes') }}">Visualisar todas os promoções</a></li>
                  <li><a href="{{ URL::to('sysadmin/promocoes/create') }}">Criar uma nova promoção</a>
              </ul>
          </nav>
          @if (session('message'))
               <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           {{ session('message') }}
                 </div>
          @endif
          <div class="panel-body">
            @if (count($promocoes) > 0)
              @foreach($promocoes as $promocao)

                <div class="box-promocao">
                  <div class="row">
                  
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <a href="{{ url('/promocoes/'.$promocao->slug) }}" title="{{ $promocao->titulo }}"><img src="{{ asset($promocao->imagem) }}" class="img-responsive"></a>
                      <br>
                      <a href="{{ route('sysadmin.promocoes.show', $promocao->id) }}" class="btn btn-info">Visualizar promoção</a>
                      <a href="{{ route('sysadmin.promocoes.edit', $promocao->id) }}" class="btn btn-primary">Editar promoção</a>


                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                      {{ $promocao->titulo }} <strong><?=($promocao->situacao=='publicado'?"Publicado":"Pendente"); ?></strong>
                        
                                        
                    </div>
                      
                  </div>
                  <hr>
                </div>
              
              @endforeach
            @else

              Nenhum produto cadastrado

            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
@stop