@extends('components.admin.master')
@section('content')
    <h2>{{auth()->user()->name}}'s Profile</h2>
    <div class="row">
        <div class="col-sm-6">
            <p>Fields marked ( <span class="mandatory">*</span> ) are mandatory</p>
            <form method="POST" action="{{ route('admin.user.update', $user) }}" enctype="multipart/form-data"> 
                @csrf
                @method('PATCH')
                @if(Session::has('updatedMessage'))
                    <div class="alert alert-success">{{Session::get('updatedMessage')}}</div>
                @endif
                <div class="form-group">
                    <label for="username"><strong>Username<span class="mandatory">*</span></strong></label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="User Name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email"><strong>Email ID<span class="mandatory">*</span></strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="Email ID">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="profile-picture"><strong>Profile Picture:</strong></label>
                    @if($user->profile_picture != '')
                    <div class="mb-4">
                        <img height="100" src="/storage/{{$user->profile_picture}}" alt="" />
                    </div>
                    @endif
                    <input type="file"class="form-control" name="profile_picture" id="profile_picture">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-submit">Update</button>
                </div>
            </form>
            @if(auth()->user()->userHasRole('Admin'))
            <!-- Roles Starts-->
            @if($roles->count() > 0)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Options</th>
                                    <th>Name</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th>Options</th>
                                    <th>Name</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td><input type="checkbox" id="{{$role->id}}"
                                            @foreach($user->roles as $user_role)
                                                @if($user_role->id == $role->id)
                                                    checked
                                                @endif
                                            @endforeach
                                            >
                                        </td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.users.role.attach', $user) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{$role->id}}" />
                                                <button type="submit" class="btn btn-primary"
                                                    @if($user->roles->contains($role))
                                                        disabled
                                                    @endif
                                                >Attach</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.users.role.detach', $user) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{$role->id}}" />
                                                <button type="submit" class="btn btn-danger"
                                                    @if(!$user->roles->contains($role))
                                                        disabled
                                                    @endif
                                                >Detach</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            @endif
            <div class="d-flex">
                <div class="mx-auto">
                <!-- Include pagination links here -->
                </div>
            </div>
        </div>
    </div>
@endsection