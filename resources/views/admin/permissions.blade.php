@extends('components.admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">Permissions</h2>
                    <a href="{{ route('admin.permission.add') }}">Add a Permission</a>
                    @if(Session::has('permission-deleted'))
                        <div class="alert alert-success">{{Session::get('permission-deleted')}}</div>
                    @elseif(Session::has('permission-saved'))
                        <div class="alert alert-success">{{Session::get('permission-saved')}}</div>
                    @elseif(Session::has('permission-updated'))
                        <div class="alert alert-success">{{Session::get('permission-updated')}}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    @if($permissions->count() > 0)
                        <table class="table table-bordered" id="permissions-table" width="100%" cellspacing="0">
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
                                @foreach($permissions as $permission)
                                <tr>
                                    <td><a href="{{ route('admin.permission.edit',$permission->id) }}">{{$permission->name}}</a></td>
                                    <td>{{$permission->slug}}</td>
                                    <td>{{$permission->created_at->diffForhumans()}}</td>
                                    <td>Active</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.permission.destroy', $permission->id) }}">
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