@extends('layouts.app')
@section('content')
    <h1>Create Superhero</h1>
    {!! Form::open(['action' => ['SuperheroesController@update', $superhero->id], 'method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('nickname', 'Nickname')}}
            {{Form::text('nickname', $superhero->nickname, ['class' => 'form-control', 'placeholder' => 'Nickname'])}}
        </div>
        <div class="form-group">   
            {{Form::label('real_name', 'Real Name')}}
            {{Form::text('real_name', $superhero->real_name, ['class' => 'form-control', 'placeholder' => 'Real Name'])}}
        </div>
        <div class="form-group">    
            {{Form::label('catch_phrase', 'Catch Phrase')}}
            {{Form::text('catch_phrase', $superhero->catch_phrase, ['class' => 'form-control', 'placeholder' => 'Catch Phrase'])}}
        </div>
        <div class="form-group">    
            {{Form::label('superpowers', 'Superpowers')}}
            {{Form::text('superpowers', $superhero->superpowers, [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Superpowers'])}}
        </div>
        <div class="form-group">    
            {{Form::label('origin_description', 'Origin Description')}}
            {{Form::textarea('origin_description', $superhero->origin_description, [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Origin Description'])}}
        </div>
       
        
        <div class="form-group">
            {{Form::file('hero_pictures[]', ['multiple'=>'true'])}}
        </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    Pictures:<br>
    <div class="row">
        <div id="mdb-lightbox-ui"></div>
        
            @if (count($hero_pictures)>0)
                @foreach ($hero_pictures as $picture)
                    <figure class="col-md-4">
                        <a class="black-text" href="/storage/hero_pictures/{{$picture->hero_picture}}">
                        <img alt="picture" src="/storage/hero_pictures/{{$picture->hero_picture}}"
                            class="img-fluid">
                        </a>
                        @if (!Auth::guest())
                        @if (Auth::user()->id == $superhero->user_id)
                            {!!Form::open(['action' => ['PicturesController@destroy', $picture->hero_picture], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        @endif
                    @endif
                    </figure>
                    @endforeach
            @else
                <img class="col-md-4" style="width:25%" src="/storage/no-pictures.png">
            @endif
    </div>
@endsection