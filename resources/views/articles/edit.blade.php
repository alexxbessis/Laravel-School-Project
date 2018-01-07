@extends('layout.blog')

@section('content')

    <h1>Edit an article</h1>

    {!! Form::open(['action' => ['ArticlesController@update', $article->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Titre')}}
        {{Form::text('title', $article->title, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('content', 'Contenu')}}
        {{Form::textarea('content', $article->content, ['class' => 'form-control'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Éditer l\'article', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
