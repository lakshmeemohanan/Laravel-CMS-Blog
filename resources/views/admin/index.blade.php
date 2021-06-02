@extends('components.admin.master')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    <div class="row">
        <div class="col-sm-12">
            <ul style="list-style-type: none;">
                @if(auth()->user()->userHasRole('Admin'))   
                <li><a href="{{ route('admin.users') }}">Users</a></li>
                @endif
                <li><a href="{{ route('admin.posts') }}">Posts</a></li>
                @if(auth()->user()->userHasRole('Admin'))
                <li><a href="{{ route('admin.user.roles') }}">Authorizations</a></li>
                <li><a href="{{ route('admin.contact') }}">Contact Us</a></li>
                <li><a href="{{ route('admin.comments') }}">Comments</a></li>
                @endif
            </ul>
        </div>
    </div>
@endsection
