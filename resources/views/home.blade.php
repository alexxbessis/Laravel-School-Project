@extends('layout.blog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="/rendu/public/articles/create" class="btn btn-default">Add an article</a>
                        <hr>
                        @if(count($articles) > 0)

                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Name of the article</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article->title}}</td>
                                        <td><a class="btn btn-default" href="/rendu/public/articles/{{$article->id}}/edit">Edit</a></td>
                                        <td>
                                            {!! Form::open(['action' => ['ArticlesController@destroy', $article->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Supprimer l\'article', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        @else
                            <p>No article for the moment</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
