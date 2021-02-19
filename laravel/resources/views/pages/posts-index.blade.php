@extends('layouts.main-layout')
@section('content')
    <ul>
        @foreach ($posts as $post)
        
            <post
                :title="'{{$post-> title}}'"
                :content="'{{$post-> content}}'"
                :likes="{{$post-> likes}}"
                :id="{{$post-> id}}"
            ></post>
        
        @endforeach
    </ul>
@endsection