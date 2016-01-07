@extends('sysadmin.layout')

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
                <li><a href="{{ URL::to('admin/promocoes') }}">Visualisar todas as promocões</a></li>
                <li><a href="{{ URL::to('admin/promocoes/create') }}">Criar uma nova promoção</a>
            </ul>
          </nav>
          <div class="panel-body">

            <h1>{{ $promocao->titulo }}</h1>
            <hr>


            <hr>
            Descrição: {!! nl2br(e($promocao->descricao)) !!}
            <hr>
            <button class="btn btn-primary" onclick="history.go(-1)">
              « Voltar
            </button>
            {!! Form::open(array('url' => 'sysadmin/promocoes/' . $promocao->id, 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Excluir essa promoção', array('class' => 'btn btn-warning')) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop