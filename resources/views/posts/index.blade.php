@extends('components.home-master')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <h2 class="my-4">Posts</h2>

          <!-- Blog Post -->
          @foreach($posts as $post)
          <div class="card mb-4">
             @if($post->featured_image)
                <img class="card-img-top" src="/storage/{{$post->featured_image}}">
              @else
                <img class="card-img-top" src="/storage/post-uploads/blank.png">
              @endif
            <div class="card-body">
              <h3 class="card-title">{{$post->title}}</h3>
              <p class="card-text">{{str_limit($post->long_description, '200', '...')}}</p>
              <a href="/posts/{{$post->id}}" class="btn btn-secondary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$post->created_at->diffForHumans()}} by
              <a href="#">{{$post->user->name}}</a>
            </div>
          </div>
          @endforeach
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul>
      </div>
    <div>
</div>
@endsection
     