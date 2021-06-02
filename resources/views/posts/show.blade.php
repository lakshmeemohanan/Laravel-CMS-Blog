@extends('components.home-master')
@section('content')
      <div class="col-lg-8">
        <h1 class="mt-4">{{$post->title}}</h1>
        @if(Session::has('comment-saved'))
          <div class="alert alert-success">{{Session::get('comment-saved')}}</div>
        @endif
        <p class="lead">
          by
          {{$post->user->name}}
        </p>
        <hr>
            <p>Posted on {{$post->created_at->diffForHumans()}}</p>
        <hr>
            <img class="img-fluid rounded" src="/storage/{{$post->featured_image}}" alt="{{$post->title}}">
        <hr>
        <p>{{$post->long_description}}</p>

        <hr>
        <!-- Comments Form -->
        @if(Auth::check())
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>

          <div class="card-body">
            <form method="POST" action="{{ route('post.comment.store', $post->id)}}">
              @csrf
              <div class="form-group">
                <textarea name="comment" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
          </div>
        </div>
        @endif
        <!-- Single Comment -->
        @foreach($comments as $comment)
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" height="20" src="/storage/{{ $comment->user->profile_picture }}" alt="{{ $comment->user->name }}">
          <div class="media-body">
            <h5 class="mt-0">{{ $comment->user->name }}</h5>
            {{$comment->comment}}
          </div>
        </div>
        @endforeach
      </div>
@endsection