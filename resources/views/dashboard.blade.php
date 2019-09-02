@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/superhero/create" class="btn btn-primary">Create new SUPERHERO</a>
                    <br><br>
                   <h3>Heroes that you create:</h3>
                   <br>
                   @if (count($superheroes)>0)
                   <table class="table table-primary">
                    <thead class="bg-dark">
                    <tr class="bg-danger">
                        <th scope="col">Picture</th>
                        <th scope="col">Nickname</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                            </thead>
                    @foreach ($superheroes as $superhero)
                        <tr>
                            @if (count($superhero->heropictures)>0)
                                <td class="w-25">
                                    <img  class="rounded-circle w-50" src="/storage/hero_pictures/{{$superhero->heropictures[0]->hero_picture}}">
                                </td>
                            @else
                                <td class="w-25">
                                    <img class="rounded-circle w-50" src="/storage/no-pictures.png">
                                </td>   
                            @endif
                            <td><a href="/superhero/{{$superhero->id}}">{{$superhero->nickname}}</a></td>
                            <td><a href="/superhero/{{$superhero->id}}/edit" class="btn btn-secondary">Edit</a></td>
                            <td> 
                                {!!Form::open(['action' => ['SuperheroesController@destroy', $superhero->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
