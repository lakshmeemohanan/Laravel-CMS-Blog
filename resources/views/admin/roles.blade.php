@extends('components.admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">Roles</h2>
                    <a href="{{ route('admin.role.add') }}">Add a role</a>
                    @if(Session::has('role-deleted'))
                        <div class="alert alert-success">{{Session::get('role-deleted')}}</div>
                    @elseif(Session::has('role-saved'))
                        <div class="alert alert-success">{{Session::get('role-saved')}}</div>
                    @elseif(Session::has('role-updated'))
                        <div class="alert alert-success">{{Session::get('role-updated')}}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    @if($roles->count() > 0)
                        <table class="table table-bordered" id="roles-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created On</th>
                                <th>Status</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created On</th>
                                <th>Status</th>
                                <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td><a href="{{ route('admin.role.edit',$role->id) }}">{{$role->name}}</a></td>
                                    <td>{{$role->slug}}</td>
                                    <td>{{$role->created_at->diffForhumans()}}</td>
                                    <td>active</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.role.destroy', $role->id) }}">
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