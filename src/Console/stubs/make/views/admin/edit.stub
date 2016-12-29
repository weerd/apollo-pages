@extends('layouts.admin.master')

@section('content')

    <h1>Admin: Update Page</h1>

    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ $page->title or old('title') }}" autofocus />
        </div>

        <div>
            <label>Slug:</label>
            <input type="text" name="slug" value="{{ $page->slug or old('slug') }}" />
        </div>

        <div>
            <label>Path:</label>
            <input type="text" name="path" value="{{ $page->path or old('path') }}" disabled="disabled" />
        </div>

        <div>
            <label>Parent page:</label>
            <input type="text" name="parent_id" value="{{ $page->parent_id or old('parent_id') }}" />
        </div>

        <div>
            <label>Body:</label>
            <textarea name="body" rows="10" cols="50">{{ $page->body or old('body') }}</textarea>
        </div>

        <div>
            <input type="submit" value="Update">
            <a href="{{ route('admin.pages.index') }}">Cancel</a>
        </div>
    </form>

@endsection
