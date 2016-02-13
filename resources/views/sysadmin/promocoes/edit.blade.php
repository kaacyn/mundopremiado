@extends('sysadmin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <script type="text/javascript" src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}"></script>
          <script type="text/javascript">
            tinymce.init({
              selector : ".editor",
              plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
              toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            }); 
          </script>

          <div class="panel-heading">
            <h3 class="panel-title">Promoções</h3>
          </div>
          <nav class="navbar navbar-inverse">
              <ul class="nav navbar-nav">
                  <li><a href="{{ URL::to('sysadmin/promocoes') }}">Visualisar todas as promoções</a></li>
                  <li><a href="{{ URL::to('sysadmin/promocoes/create') }}">Criar uma nova promoção</a>
              </ul>
          </nav>
          <div class="panel-body">
            <h1>Adicionar promoção</h1>
            <hr>
            {!! HTML::ul($errors->all()) !!}

            {!! Form::model($promocao, array(
            'route' => array('sysadmin.promocoes.update', $promocao->id), 
            'method' => 'PUT',
            'files' => true
            )) 
            !!}


            <div class="form-group">
                {!! Form::radio('situacao', 'pendente', true, array('id'=>'situacao-pendente')) !!}
                {!! Form::label('situacao-pendente', 'Pendente', ['class' => 'control-label']) !!} 

                {!! Form::radio('situacao', 'publicado', false ,array('id' => 'situacao-publicado')) !!}
                {!! Form::label('situacao-publicado', 'Publicado', ['class' => 'control-label']) !!} 
            </div>
            <div class="form-group">
                {!! Form::label('titulo', 'Titulo:', ['class' => 'control-label']) !!}
                {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug:', ['class' => 'control-label']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('imagem','Imagem (456x240px)',array('id'=>'','class'=>'')) !!}
              {!! Form::file('imagem','',array('id'=>'','class'=>'')) !!}
          
              <img src="{{ asset($promocao->imagem) }}">
            </div>
            <div class="form-group">
                {!! Form::label('url_hotsite', 'Link Hotsite:', ['class' => 'control-label']) !!}
                {!! Form::url('url_hotsite', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('url_ganhadores', 'Link Ganhadores:', ['class' => 'control-label']) !!}
                {!! Form::url('url_ganhadores', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('url_regulamento', 'Link Regulamento:', ['class' => 'control-label']) !!}
                {!! Form::url('url_regulamento', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <?php $data_inicio = DateTime::createFromFormat('Ymd', $promocao->data_inicio);   
                if(empty($promocao->data_inicio)):
                  $data_inicio = "";
                else:
                  $data_inicio = $data_inicio->format('d/m/Y');
                endif;?>

                {!! Form::label('data_inicio', 'Data Início:', ['class' => 'control-label']) !!}
                {!! Form::text('data_inicio', $data_inicio, ['class' => 'form-control datepicker']) !!}
            </div>
            <div class="form-group">
                <?php $data_fim = DateTime::createFromFormat('Ymd', $promocao->data_fim);   
                if(empty($promocao->data_fim)):
                  $data_fim = "";
                else:
                  $data_fim = $data_fim->format('d/m/Y');
                endif;?>
                {!! Form::label('data_fim', 'Data Fim:', ['class' => 'control-label ']) !!}
                {!! Form::text('data_fim',$data_fim , ['class' => 'form-control datepicker']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('valor_minimo', 'Valor Mínimo:', ['class' => 'control-label']) !!}
                {!! Form::text('valor_minimo', RealForDecimal($promocao->valor_minimo), ['class' => 'form-control mask_money','placeholder' => 'Valor mínimo para participar da promoção (R$)']) !!}
            </div>

            <div class="form-group">
              <h3>Cadastro de Sorteios e Prêmios</h3>

              <div ng-app="angularjs-starter" ng-controller="Sorteios">
                <fieldset  data-ng-repeat="sorteio in sorteios">
                  <input type="text" ng-model="sorteio.periodo_inicio" class="datepicker" name="sorteios[<% $index %>][periodo_inicio]" placeholder="Período início">
                  <input type="text" ng-model="sorteio.periodo_fim" class="datepicker" name="sorteios[<% $index %>][periodo_fim]" placeholder="Período fim">
                  <input type="text" ng-model="sorteio.data_sorteio" class="datepicker" name="sorteios[<% $index %>][data_sorteio]" placeholder="Data Sorteio">
                  <input type="text" ng-model="sorteio.observacao" name="sorteios[<% $index %>][observacao]" placeholder="Observação">
                  <button type="button" class="remove" ng-show="isSorteioRemovivel()" ng-click="removeSorteio($index)">-</button>
                  <div class="premios">

                    <fieldset  data-ng-repeat="premio in sorteio.premios">
                        <input type="text" class="text_quantidade" maxlength="6" ng-model="premio.quantidade" name="sorteios[<% $parent.$index %>][premios][<% $index %>][quantidade]" placeholder="Quantidade">
                        <input type="text" class="text_nome" ng-model="premio.nome" name="sorteios[<% $parent.$index %>][premios][<% $index %>][nome]" placeholder="Descrição simples do prêmio">
                        <input type="text" class="mask_money text_valor" ng-model="premio.valor" name="sorteios[<% $parent.$index %>][premios][<% $index %>][valor]" placeholder="Valor unitário (R$)">
                        <button type="button" class="remove" ng-show="isPremioRemovivel(sorteio)" ng-click="removePremio($index,sorteio)">-</button>                
                        <textarea name="sorteios[<% $parent.$index %>][premios][<% $index %>][descricao]"  ng-model="premio.descricao"  placeholder="Descrição copleta do prêmio"></textarea>

                     </fieldset>
                     <button type="button" class="addfields" ng-click="addNewPremio(sorteio)">Adicionar Prêmio</button>
                  </div>
                </fieldset>
                   
                 <button type="button" class="addfields" ng-click="addNewSorteio()">Adicionar Sorteio</button>
                     

              </div>

              <script type="text/javascript">
                var sorteios_arr = <? echo json_encode($sorteios); ?>;
              </script>
            </div>

            <div class="form-group">
                {!! Form::label('premiacao', 'Descrição premiação:', ['class' => 'control-label']) !!}
                {!! Form::textarea('premiacao', null, ['class' => 'form-control editor','placeholder' => 'Descrição premiação separados por virgula']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('regiao', 'Região', ['class' => 'control-label']) !!}
                {!! Form::text('regiao', null, ['class' => 'form-control','placeholder' => 'Exemplo: todo brasil']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('descricao', 'Descrição:', ['class' => 'control-label']) !!}
                {!! Form::textarea('descricao', $promocao->descricao, ['class' => 'form-control editor']) !!}
            </div>






            {!! Form::submit('Atualizar promoção', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop