@extends('layout.blog')

@section('content')


    <h1>Create an article</h1>

    {!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Titre')}}
        {{Form::text('title', '', ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('content', 'Contenu')}}
        {{Form::textarea('content', '', ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::file('image')}}
    </div>
    {{Form::submit('Soumettre le formulaire', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
