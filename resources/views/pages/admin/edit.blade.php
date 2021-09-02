@extends('apollo-pages::layouts.admin.master')

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
            <input type="text" name="title" value="{{ $page->title ?? old('title') }}" autofocus />
        </div>

        <div>
            <label>Slug:</label>
            <input type="text" name="slug" value="{{ $page->slug ?? old('slug') }}" />
        </div>

        <div>
            <label>Path:</label>
            <input type="text" name="path" value="{{ $page->path ?? old('path') }}" disabled="disabled" />
        </div>

        <div>
            <label for="parent_id">Parent page:</label>
            <select name="parent_id" id="parent_id">
                <option value="">None</option>
                @if($pageList->count())
                    @foreach($pageList as $pageItem)
                        <option value="{{ $pageItem->id }}"
                            {{ ((int) old('parent_id') === $pageItem->id) || ($page->parent_id === $pageItem->id) ? 'selected' : '' }}
                        >
                            {{ $pageItem->title }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div>
            <label>Body:</label>
            <textarea name="body" rows="10" cols="50">{{ $page->body ?? old('body') }}</textarea>
        </div>

        <div>
            <input type="submit" value="Update">
            <a href="{{ route('admin.pages.index') }}">Cancel</a>
        </div>
    </form>

@endsection
