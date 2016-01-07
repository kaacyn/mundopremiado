@extends('admin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Produtos</h3>
          </div>
          <nav class="navbar navbar-inverse">
              <ul class="nav navbar-nav">
                  <li><a href="{{ URL::to('admin/produto') }}">Visualisar todos os produtos</a></li>
                  <li><a href="{{ URL::to('admin/produto/create') }}">Criar um novo produto</a>
              </ul>
          </nav>
          @if (session('message'))
               <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           {{ session('message') }}
                 </div>
          @endif
          <div class="panel-body">

            @foreach($produtos as $produto)
                <h3>{{ $produto->nome }}</h3>
                <p>{{ $produto->descricao}}</p>
                <p>
                    <a href="{{ route('admin.produto.show', $produto->id) }}" class="btn btn-info">Visualizar produto</a>
                    <a href="{{ route('admin.produto.edit', $produto->id) }}" class="btn btn-primary">Editar produto</a>
                </p>
                <hr>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
@stop