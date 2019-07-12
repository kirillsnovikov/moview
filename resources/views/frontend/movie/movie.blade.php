@extends('layouts.app')

@section('title', $movie->meta_title)
@section('meta_title', $movie->meta_title)
@section('meta_keyword', $movie->meta_keyword)
@section('meta_description', $movie->meta_description)

@section('content')
<div class="main-content">
    <div class="content-layout">
        <div class="left-right-sidebar">
            @include('frontend.movie.particles.content')
            @include('frontend.movie.particles.sidebar-left')
            @include('frontend.movie.particles.sidebar-right')
        </div>
    </div>
</div>
@endsection
