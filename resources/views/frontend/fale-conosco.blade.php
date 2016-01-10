@extends('frontend.layout')

@section('title', "Fale Conosco - " )
@section('description',  "" )

@section('content')

  <div class="container">

    <div class="row">
    
      <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
       Para maiores informações entre em contato conosco.
      </div>
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(array('route' => 'fale-conosco-store', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Seu Nome') !!}
            {!! Form::text('nome', null, 
                array('required', 
                      'class'=>'form-control', 
                      'placeholder'=>'Seu Nome')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Seu E-mail') !!}
            {!! Form::text('email', null, 
                array('required', 
                      'class'=>'form-control', 
                      'placeholder'=>'Seu endereço de e-mail')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Sua mensagem') !!}
            {!! Form::textarea('mensagem', null, 
                array('required', 
                      'class'=>'form-control', 
                      'placeholder'=>'Sua Mensagem')) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Enviar', 
              array('class'=>'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop