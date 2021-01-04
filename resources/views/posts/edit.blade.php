@extends('layouts.app')
@section('title')
    Edit Post
@endsection
@section('content')
<form method="post" action='{{ url("/update") }}' enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
    <div class="form-group">
      <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
    </div>
    <div class="form-group">
      <textarea name='body'class="form-control">
        @if(!old('body'))
        {!! $post->body !!}
        @endif
        {!! old('body') !!}
      </textarea>
    </div>
    <div class="form-group">
        <img src="{{ url($post->image) }}" class="img-rounded" alt="POst image">
        <a href="{{  url('delete/'.$post->id.'/'.$post->author_id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete Image</a>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Upload Feature Image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" name="category_id" required>
            <option value="">Select a Category</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                @if ($category->children)
                    @foreach ($category->children as $child)
                        <option value="{{ $child->id }}" {{ $child->id === old('category_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                    @endforeach
                @endif
            @endforeach
        </select>
    </div>
    @if($post->active == '1')
    <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
    @else
    <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
    @endif
    <input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
    <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
  </form>
@endsection
