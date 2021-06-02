@extends('components.admin.master')
@section('content')
    <h2>Edit Role - {{ $role->name }}</h2>
    <div class="row">
        <div class="col-sm-12">
            <p>Fields marked ( <span class="mandatory">*</span> ) are mandatory</p>
            <form method="POST" action="{{ route('admin.role.update', $role->id) }}" >
            @csrf
            @method('PATCH')
                <div class="form-group">
                    <label for="name">Name<span class="mandatory">*</span></label>
                    <input type="text" class="form-control" value="{{ $role->name }}" name="name" />
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">Permissions</h2>
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
                    @if($permissions->isNotEmpty())
                        <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Options</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created On</th>
                                <th>Attach</th>
                                <th>Detach</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Options</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created On</th>
                                <th>Attach</th>
                                <th>Detach</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="{{$permission->id}}"
                                            @foreach($role->permissions as $role_permission)
                                                @if($role_permission->id == $permission->id)
                                                    checked
                                                @endif
                                            @endforeach
                                            >
                                    </td>
                                    <td><a href="{{ route('admin.permission.edit',$role->id) }}">{{$permission->name}}</a></td>
                                    <td>{{$permission->slug}}</td>
                                    <td>{{$permission->created_at->diffForhumans()}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.role.permissions.attach', $role) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="permission" value="{{$permission->id}}" />
                                            <button type="submit" class="btn btn-primary"
                                                @if($role->permissions->contains($permission))
                                                    disabled
                                                @endif
                                            >Attach</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.role.permissions.detach', $role) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="permission" value="{{$permission->id}}" />
                                            <button type="submit" class="btn btn-danger"
                                                @if(!$role->permissions->contains($permission))
                                                    disabled
                                                @endif
                                            >Detach</button>
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
<!-- Page level custom scripts -->
<script src="{{asset('js/datatables.js')}}"></script>
@endsection