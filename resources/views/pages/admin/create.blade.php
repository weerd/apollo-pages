@extends('apollo-pages::layouts.admin.master')

@section('content')

    <h1>Admin: Create Page</h1>

    <form method="POST" action="{{ route('admin.pages.store') }}">
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
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" autofocus />
        </div>

        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" />
        </div>

        <div>
            <label for="parent_id">Parent page:</label>
            <select name="parent_id" id="parent_id">
                <option value="">None</option>
                @if($pageList->count())
                    @foreach($pageList as $pageItem)
                        <option value="{{ $pageItem->id }}" {{ (int) old('parent_id') === $pageItem->id ? 'selected' : '' }}>
                            {{ $pageItem->title }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div>
            <label for="body">Body:</label>
            <textarea name="body" id="body" value="{{ old('body') }}" rows="10" cols="50"></textarea>
        </div>

        <div>
            <input type="submit" value="Submit">
            <a href="{{ route('admin.pages.index') }}">Cancel</a>
        </div>
    </form>

@endsection
