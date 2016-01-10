@extends('sysadmin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <script type="text/javascript" src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}"></script>
          <script type="text/javascript">
            tinymce.init({
              selector : "textarea",
              plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
              toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            }); 
          </script>


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
                {!! Form::radio('situacao', 'pendente', true, array('id'=>'situacao-pendente')) !!}
                {!! Form::label('situacao-pendente', 'Pendente', ['class' => 'control-label']) !!} 

                {!! Form::radio('situacao', 'publicado', false ,array('id' => 'situacao-publicado')) !!}
                {!! Form::label('situacao-publicado', 'Publicado', ['class' => 'control-label']) !!} 
            </div>

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
                {!! Form::text('valor_minimo', null, ['class' => 'form-control mask_money']) !!}
            </div>

            <div class="form-group">
              <h3>Cadastro de prêmios</h3>

              <hr/>

              <div ng-app="angularjs-premios" id="premios-box" ng-controller="MainCtrl">

                 <fieldset  data-ng-repeat="choice in choices">
                  <input type="number" class="text_quantidade" maxlength="6" ng-model="choice.quantidade" name="premios[quantidade][]" placeholder="Quantidade">
                    <input type="text" class="text_nome" ng-model="choice.nome" name="premios[nome][]" placeholder="Nome">
                    <input type="text" class="mask_money text_valor" ng-model="choice.valor" name="premios[valor][]" placeholder="Valor unitário (R$)">
                    <button class="remove" ng-show="$last" ng-click="removeChoice()">-</button>
                 </fieldset>
  
                 <button type="button" class="addfields" ng-click="addNewChoice()">Adicionar Prêmio</button>
              </div>
              <script type="text/javascript">
                var premios_arr =  [{id: 'choice1'}, {id: 'choice2'}];
              </script>
            </div>
            <div class="form-group">
                {!! Form::label('premiacao', 'Descrição dos prêmios:', ['class' => 'control-label']) !!}
                {!! Form::textarea('premiacao', null, ['class' => 'form-control','placeholder' => 'Descrição dos prêmios']) !!}
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