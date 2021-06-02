@extends('components.admin.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Posts</h2>
            <span style="text-align:right"><a href="{{ route('admin.post.add') }}">Add a Post</a></span>
            @if(Session::has('post-deleted'))
                <div class="alert alert-success">{{Session::get('post-deleted')}}</div>
            @elseif(Session::has('post-saved'))
            <div class="alert alert-success">{{Session::get('post-saved')}}</div>
            @elseif(Session::has('post-updated'))
              <div class="alert alert-success">{{Session::get('post-updated')}}</div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($posts->count() > 0)
                    <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>By</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>By</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td><a href="{{ route('admin.post.edit', $post->id) }}">{{$post->title}}</a></td>
                                <td><img height="30" src="/storage/{{$post->featured_image}}" alt="{{$post->title}}"></td>
                                <td><a href="{{route('admin.post.edit',$post->id)}}" >{{$post->user->name}}</a></td>
                                <td>{{$post->created_at->diffForhumans()}}</td>
                                <td>{{$post->updated_at->diffForhumans()}}</td>
                                <td>active</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.post.destroy', $post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="Delete" />
                                    </form>
                                </td>                                    
                            </tr>
                            @endforeach
                    </tbody>
                    </table>
                @else
                    <p class="alert alert-danger">No Records Found</p>
                @endif
              </div>
            </div>
          </div>
          <div class="d-flex">
            <div class="mx-auto">
                {{$posts->links()}}
            </div>
          </div>

@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<!--<script src="{{asset('js/datatables.js')}}"></script>-->
@endsection