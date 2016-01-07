@extends('admin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Tipo</h3>
          </div>
          <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('admin/produto') }}">Visualisar todos os produtos</a></li>
                <li><a href="{{ URL::to('admin/produto/create') }}">Criar um novo produto</a>
            </ul>
          </nav>
          <div class="panel-body">

            <h1>{{ $produto->nome }}</h1>
            <hr>
            Tipo: {!! $produto->Tipo->nome !!}
            <hr>
            Imposto: {!! $produto->Tipo->imposto !!}%
            <hr>
            Descrição: {!! nl2br(e($produto->descricao)) !!}
            <hr>
            <button class="btn btn-primary" onclick="history.go(-1)">
              « Voltar
            </button>
            {!! Form::open(array('url' => 'admin/produto/' . $produto->id, 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Excluir esse produto', array('class' => 'btn btn-warning')) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop