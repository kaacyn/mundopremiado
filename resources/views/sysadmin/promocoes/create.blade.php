@extends('sysadmin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Promoção</h3>
          </div>
          <nav class="navbar navbar-inverse">
              <ul class="nav navbar-nav">
                  <li><a href="{{ URL::to('sysadmin/promocoes') }}">Visualisar todos os promoções</a></li>
                  <li><a href="{{ URL::to('sysadmin/promocoes/create') }}">Criar um novo promocoes</a>
              </ul>
          </nav>
          <div class="panel-body">
            <h1>Adicionar promoção</h1>
            <hr>
            {!! HTML::ul($errors->all()) !!}

            {!! Form::open([
                'route' => 'sysadmin.promocoes.store',
                'files' => true
            ]) !!}

            <div class="form-group">
                {!! Form::label('titulo', 'Título:', ['class' => 'control-label']) !!}
                {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('imagem','Imagem (456x240px)',array('id'=>'','class'=>'')) !!}
              {!! Form::file('imagem','',array('id'=>'','class'=>'')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('url_hotsite', 'Link Hotsite:', ['class' => 'control-label']) !!}
                {!! Form::url('url_hotsite', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('url_regulamento', 'Link Regulamento:', ['class' => 'control-label']) !!}
                {!! Form::url('url_regulamento', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('data_inicio', 'Data Início:', ['class' => 'control-label']) !!}
                {!! Form::text('data_inicio', null, ['class' => 'form-control datepicker']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('data_fim', 'Data Fim:', ['class' => 'control-label ']) !!}
                {!! Form::text('data_fim', null, ['class' => 'form-control datepicker']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('valor_minimo', 'Valor Mínimo:', ['class' => 'control-label']) !!}
                {!! Form::text('valor_minimo', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('valor_premiacao', 'Total em prêmios:', ['class' => 'control-label']) !!}
                {!! Form::text('valor_premiacao', null, ['class' => 'form-control mask_money','placeholder' => 'Valor total em prêmios (R$)']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('premiacao', 'Prêmios:', ['class' => 'control-label']) !!}
                {!! Form::text('premiacao', null, ['class' => 'form-control','placeholder' => 'Prêmios separados por virgula']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('regiao', 'Região', ['class' => 'control-label']) !!}
                {!! Form::text('regiao', null, ['class' => 'form-control','placeholder' => 'Exemplo: todo brasil']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('descricao', 'Descrição:', ['class' => 'control-label']) !!}
                {!! Form::textarea('descricao', null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Criar nova promoção', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop