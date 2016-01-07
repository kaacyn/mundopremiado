@extends('admin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Produto</h3>
          </div>
          <nav class="navbar navbar-inverse">
              <ul class="nav navbar-nav">
                  <li><a href="{{ URL::to('admin/produto') }}">Visualisar todos os produtos</a></li>
                  <li><a href="{{ URL::to('admin/produto/create') }}">Criar um novo produto</a>
              </ul>
          </nav>
          <div class="panel-body">

            <h1>Adicionar novo Produto</h1>
            <p class="lead">Adicionar um novo produto para lista.</p>
            <hr>
            {!! HTML::ul($errors->all()) !!}

            {!! Form::open([
                'route' => 'admin.produto.store'
            ]) !!}

            <div class="form-group">
                {!! Form::label('nome', 'Nome:', ['class' => 'control-label']) !!}
                {!! Form::text('nome', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('preco', 'Preço:', ['class' => 'control-label']) !!}
                {!! Form::text('preco', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Tipo:') !!}<br />
                {!! Form::select('tipo', $tipos) !!}
            </div>
            <div class="form-group">
                {!! Form::label('descricao', 'Descrição:', ['class' => 'control-label']) !!}
                {!! Form::textarea('descricao', null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Criar novo produto', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop