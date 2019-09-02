@extends('layouts.app')
@section('content')
<div class="content m-3">
    Nickname:
    <h3 class="m-3"> {{$superhero->nickname}}</h3>
    <div>
            Real Name: 
            <h3 class="m-3"> {{$superhero->real_name}}</h3>
    </div>
    <div>
             Catch Phrase: 
            <h3 class="m-3">  {{$superhero->catch_phrase}}</h3>
    </div>
    <div>
             Superpowers:
            <h3 class="m-3"> {!!$superhero->superpowers!!}</h3>
    </div>
    <div>
             Origin description:
            <h3 class="m-3"> {!!$superhero->origin_description!!}</h3>
    </div>
    
    Pictures:<br>
    <div class="row m-3">
        <div id="mdb-lightbox-ui"></div>
            @if (count($hero_pictures)>0)
                @foreach ($hero_pictures as $picture)
                    <figure class="col-md-4">
                        <a class="black-text" href="/storage/hero_pictures/{{$picture->hero_picture}}">
                        <img alt="picture" src="/storage/hero_pictures/{{$picture->hero_picture}}"
                            class="img-fluid">
                        </a>
                    </figure>
                    @endforeach
            @else
            <div class="view view-cascade overlay">
                <img class="w-50" src="/storage/no-pictures.png">
                <p>I don't see picture with this hero :( Tell me that you have one?!</p>
            </div>
            @endif
    </div>

    {{-- <small>Created by {{$superhero->user->name}}</small> --}}
    <div class="d-flex justify-content-between">
    @if (!Auth::guest())
        @if (Auth::user()->id == $superhero->user_id)
            <a href="/superhero/{{$superhero->id}}/edit" class="btn btn-primary mr-5">Edit</a>

            {!!Form::open(['action' => ['SuperheroesController@destroy', $superhero->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
</div>
</div>
@endsection