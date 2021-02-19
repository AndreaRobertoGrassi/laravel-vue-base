@extends('layouts.main-layout')
@section('content')
    <h1>Post</h1>
    <post 
        :creator="true"
    ></post>
    @foreach ($posts as $post)
    
        
        <post
            :title="'{{$post-> title}}'"
            :content="'{{$post-> content}}'"
            :likes="{{$post-> likes}}"
            :id="{{$post-> id}}"
            :creator="false"
        ></post>
    
    @endforeach

@endsection