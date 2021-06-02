@extends('components.admin.master')
@section('content')
    <h2>Add a Role</h2>
    <p>Fields marked ( <span class="mandatory">*</span> ) are mandatory</p>
    <form method="POST" action="{{ route('admin.role.store') }}">
    @csrf
        <div class="form-group">
            <label for="name">Name<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="name" />
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
@endsection