@extends('layouts.app')
@section('content')
    <h1>Create Superhero</h1>
    {!! Form::open(['action' => 'SuperheroesController@store', 'method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('nickname', 'Nickname')}}
            {{Form::text('nickname', '', ['class' => 'form-control', 'placeholder' => 'Nickname'])}}
        </div>
        <div class="form-group">   
            {{Form::label('real_name', 'Real Name')}}
            {{Form::text('real_name', '', ['class' => 'form-control', 'placeholder' => 'Real Name'])}}
        </div>
        <div class="form-group">    
            {{Form::label('catch_phrase', 'Catch Phrase')}}
            {{Form::text('catch_phrase', '', ['class' => 'form-control', 'placeholder' => 'Catch Phrase'])}}
        </div>
        <div class="form-group">    
            {{Form::label('superpowers', 'Superpowers')}}
            {{Form::text('superpowers', '', ['class' => 'form-control', 'placeholder' => 'Superpowers'])}}
        </div>
        <div class="form-group">    
            {{Form::label('origin_description', 'Origin Description')}}
            {{Form::textarea('origin_description', '', [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Origin Description'])}}
        </div>
        <div class="form-group">
            {{Form::file('hero_pictures[]', ['multiple'=>'true'])}}
        </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection