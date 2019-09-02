@extends('layouts.app')
@section('content')

    <h1 class="m-3">Superheroes that I know:</h1>
    <div class="row">
        @if(count($superheroes)>0)
            @foreach ($superheroes as $superhero)
           
                <div class="card card-cascade wider w-25 bg-primary m-2">
                    <a href="/superhero/{{$superhero->id}}">
                    <!-- Card image -->
                    <div class="view view-cascade overlay">
                            @if (count($superhero->heropictures)>0)
                            <img class="card-img-top" src="/storage/hero_pictures/{{$superhero->heropictures[0]->hero_picture}}" alt="Hero picture">
                                @else
                            <img class="card-img-top" src="/storage/no-pictures.png" alt="Hero picture">
                                @endif
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">
                    <!-- Subtitle -->
                    <h5 class="text-light "><strong>{{$superhero->nickname}}</strong></h5>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
        @else
        @endif

        @if (!Auth::guest())
        <a href="/dashboard">
            <p>I Don't know about any superhero yet. Please help me!</p>
        </a>
        @else
        <a href="/login">
            <p>I Don't know about any superhero yet. Please help me!</p>
        </a>
        @endif
@endsection