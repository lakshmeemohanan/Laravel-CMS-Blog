@extends('components.admin.master')
@section('content')

    <h2>Edit Post - {{ $post->title }}</h2>
    <p>Fields marked ( <span class="mandatory">*</span> ) are mandatory</p>
    <form method="POST" action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data"> 
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label><strong>Title<span class="mandatory">*</span></strong></label>
            <input type="text" name="title" value="{{$post->title}}" class="form-control" placeholder="Title">
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label><strong>Short Description<span class="mandatory">*</span></strong></label>
             <textarea name="short_description" class="form-control" placeholder="Short Description">{{$post->short_description}}</textarea>
             @if ($errors->has('short_description'))
                <span class="text-danger">{{ $errors->first('short_description') }}</span>
             @endif
        </div>
        <div class="form-group">
            <label><strong>Long Description<span class="mandatory">*</span></strong></label>
             <textarea name="long_description" cols="30" rows="10" class="form-control" placeholder="Long Description">{{$post->long_description}}</textarea>
             @if ($errors->has('long_description'))
                <span class="text-danger">{{ $errors->first('long_description') }}</span>
             @endif
        </div>
        <div class="form-group">
            <label><strong>Featured Image</strong></label>
            <div><img height="100" src="/storage/{{$post->featured_image}}"></div><br/>
            <input type="file"class="form-control" name="featured_image" id="featured_image">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-submit">Update</button>
        </div>
    </form>
@endsection