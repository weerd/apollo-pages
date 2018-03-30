@extends('apollo-pages::layouts.client.master')

@section('content')

    <h1>{{ $page->title }}</h1>

    <div>{{ $page->body_markup }}</div>

@endsection
