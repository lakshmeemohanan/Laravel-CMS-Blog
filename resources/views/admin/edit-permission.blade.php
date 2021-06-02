@extends('components.admin.master')
@section('content')
    <h2>Edit Permission - {{ $permission->name }}</h2>
    <div class="row">
        <div class="col-sm-12">
            <p>Fields marked ( <span class="mandatory">*</span> ) are mandatory</p>
            <form method="POST" action="{{ route('admin.permission.update', $permission->id) }}" >
            @csrf
            @method('PATCH')
                <div class="form-group">
                    <label for="name">Name<span class="mandatory">*</span></label>
                    <input type="text" class="form-control" value="{{ $permission->name }}" name="name" />
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
@endsection