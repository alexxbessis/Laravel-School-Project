@extends('layout.blog')

@section('content')

    @if(count($articles) > 0)

        @foreach($articles as $article)

            <div class="well">
                <h1><a href="/rendu/public/articles/{{$article->id}}">{{$article->title}}</a></h1>
                <p>{{$article->content}}</p>
                <hr>
                <small>{{$article->user->name}} |{{$article->created_at}}</small>
            </div>

         @endforeach

        {{$articles->links()}}

        @else

             <p>No article for the moment.</p>

        @endif

    @endsection
