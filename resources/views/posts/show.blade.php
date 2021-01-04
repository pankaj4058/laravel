@extends('layouts.app')
@section('title')
@if ($post)

    {{$post->title}}

    @if (!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))

        <button class="btn" style="float: right"><a href="{{url('edit/'.$post->slug)}}">EDIT POST</a></button>
    @endif
    @else
        Page does Not Exists
@endif
@endsection
@section('title-meta')
    <p>{{$post->created_at->format('M d,Y  h:i a')}} By <a href="{{ url('user/'.$post->author_id)}}">{{$post->author->name}}</a></p>
@endsection
@section('content')
@if ($post->image)
    <div>
        <img src="{{url($post->image)}}" class="img-fluid" alt="Responsive image">
    </div>
    <p class="text-muted">Category:-{{ $post->category ? $post->category->name : 'Uncategorized' }}</p>
@endif
@if ($post)

    <div>
        {!! $post->body !!}
    </div>
    <div>
        <h2>Leave a comment</h2>
      </div>
      @if (Auth::guest())
          Login to comment
        @else
        <div class="panel-body">
            <form method="post" action="comment/add">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <input type="hidden" name="on_post" value="{{ $post->id }}">
                <input type="hidden" name="slug" value="{{$post->slug}}">
                <div class="form-group">
                <textarea required="required" placeholder="Enter Comment Here" class="form-control" name="body">
                </textarea>
                <input type="submit" value="Post" class="btn btn-success" name="post_comment" />
                </div>
            </form>
        </div>
      @endif
      <div>
      @if ($comments)
      <ul style="list-style: none; padding: 0">
        @foreach ($comments as $comment)
        <li class="panel-body">
            <div class="list-group">
                <div class="list-group-item">
                    <h3>{{$comment->author->name}}</h3>
                    <p>{{$comment->created_at->format('M d,Y h:i a')}}</p>
                </div>
                <div class="list-group-item">
                    <p>{{ $comment->body }}</p>
                </div>
            </div>
        </li>
        @endforeach

        </ul>
      @endif
    </div>
    @else
        404 Error
    @endif
@endsection
