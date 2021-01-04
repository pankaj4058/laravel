@extends('layouts.app')
@section('title')
    ADD NEW POST
@endsection
@section('content')

        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">

            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />

            </div>

            <div class="form-group">

            <textarea name='body'class="form-control">{{ old('body') }}</textarea>

            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Feature Image</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" required>
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

            <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>

            <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />

            </form>

@endsection
