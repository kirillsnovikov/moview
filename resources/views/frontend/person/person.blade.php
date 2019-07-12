@extends('layouts.app')

@section('title', $person->meta_title)
@section('meta_title', $person->meta_title)
@section('meta_keyword', $person->meta_keyword)
@section('meta_description', $person->meta_description)

@section('content')
<div class="main-content">
    <div class="content-layout">
        <div class="left-right-sidebar">
            @include('frontend.person.particles.content')
            @include('frontend.person.particles.sidebar-left')
            @include('frontend.person.particles.sidebar-right')
        </div>
    </div>
</div>
@endsection


