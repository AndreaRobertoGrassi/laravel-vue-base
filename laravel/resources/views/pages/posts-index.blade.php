@extends('layouts.main-layout')
@section('content')
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