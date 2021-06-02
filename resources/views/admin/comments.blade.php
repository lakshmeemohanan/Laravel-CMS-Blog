@extends('components.admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">Comments</h2>
                    @if(Session::has('comment-deleted'))
                        <div class="alert alert-success">{{Session::get('comment-deleted')}}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    @if($comments->count() > 0)
                        <table class="table table-bordered" id="comments-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Post</th>
                                <th>User</th>
                                <th>Comment</th>
                                <th>Commented On</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Post</th>
                                <th>User</th>
                                <th>Comment</th>
                                <th>Commented On</th>
                                <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->post->title}}</td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{$comment->comment}}</td>
                                    <td>{{$comment->created_at->diffForhumans()}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.comment.destroy', $comment->id) }}">
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
        </div>
    <div>
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/datatables.js')}}"></script>
@endsection