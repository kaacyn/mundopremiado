@extends('frontend.layout')

@section('title', "Envie sua promoção - " )
@section('description',  "" )

@section('content')

  <div class="container">

    <div class="row">
    
      <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <p>
          Para enviar uma promoção basta preencher o formulário nessa página. 
       </p>
       <p>
        É obrigatório informar o hotsite com informações e regulamento.
       </p>
       Após o envio a promoção será analisa e cadastrada o mais rápido possível. Você será notificado por e-mail.
       <p>
       Para outras informações entre em <a href="{{ url('/fale-conosco') }}">contato conosco.</a>
       </p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(array('route' => 'envie-sua-promocao-store', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Seu Nome') !!}
            {!! Form::text('nome', null, 
                array('required', 
                      'class'=>'form-control', 
                      'placeholder'=>'Seu Nome')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Seu E-mail') !!}
            {!! Form::email('email', null, 
                array('required', 
                      'class'=>'form-control', 
                      'placeholder'=>'Seu endereço de e-mail')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Hotsite da promoção') !!}
            {!! Form::url('hotsite', null, 
                array('required', 
                      'class'=>'form-control', 
                      'placeholder'=>'Hotsite da promoção')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Observação') !!}
            {!! Form::textarea('observacao', null, 
                array(
                      'class'=>'form-control', 
                      'placeholder'=>'Observação')) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Enviar promoção', 
              array('class'=>'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop