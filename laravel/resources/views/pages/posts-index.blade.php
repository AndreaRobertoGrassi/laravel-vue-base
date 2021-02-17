@extends('layouts.main-layout')
@section('content')
    <ul>
        @foreach ($posts as $post)
        
            <post
                :title="'{{$post-> title}}'"
                :content="'{{$post-> content}}'"
                :likes="{{$post-> likes}}"
            ></post>
        
        @endforeach
    </ul>
@endsection