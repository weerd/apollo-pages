@extends('apollo-pages::layouts.admin.master')

@section('content')

    <h1>Admin: Page List</h1>

    <a href="{{ route('admin.pages.create') }}">Add new page</a>

    @if ($pages->count())
        <ul>
            @foreach ($pages as $page)
                <li>
                    {{ $page->title }}
                    <a href="{{ route('admin.pages.edit', $page->id) }}">Edit</a>
                    <a href="{{ route('client.pages.show', $page->path) }}" target="_blank">View</a>
                    <form method="POST" action="{{ route('admin.pages.destroy', $page->id) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <div>
                            <input type="submit" value="Delete">
                        </div>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

@endsection
