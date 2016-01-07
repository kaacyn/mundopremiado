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
                {!! Form::label('valor_premiacao', 'Total em prêmios:', ['class' => 'control-label']) !!}
                {!! Form::text('valor_premiacao', RealForDecimal($promocao->valor_premiacao), ['class' => 'form-control mask_money','placeholder' => 'Valor total em prêmios (R$)']) !!}
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
                {!! Form::textarea('descricao', $promocao->descricao, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Atualizar Promoções', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop