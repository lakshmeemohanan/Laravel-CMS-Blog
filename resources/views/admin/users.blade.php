@extends('components.admin.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Users</h2>
            @if(Session::has('user-deleted'))
                <div class="alert alert-success">{{Session::get('user-deleted')}}</div>
            @elseif(Session::has('user-saved'))
            <div class="alert alert-success">{{Session::get('user-saved')}}</div>
            @elseif(Session::has('user-updated'))
              <div class="alert alert-success">{{Session::get('user-updated')}}</div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($users->count() > 0)
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Profile Picture</th>
                            <th>Registered On</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Profile Picture</th>
                            <th>Registered On</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><a href="/admin/users/{{$user->id}}/profile">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td><img height="30" src="/storage/{{$user->profile_picture}}" alt="{{$user->name}}"></td>
                                <td>{{$user->created_at->diffForhumans()}}</td>
                                <td>Active</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}">
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
                <!-- Include pagination links here -->
            </div>
          </div>

@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/datatables.js')}}"></script>
@endsection