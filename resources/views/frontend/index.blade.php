@extends('layouts.app')

@section('title', 'Он-лайн сервис просмотра фильмов в хорошем качестве FullHD, HD720, HD1080')
@section('meta_title', 'Новинки лучших фильмов и сериалов смотреть он-лайн в хорошем качестве')
@section('meta_keyword', 'Фильмы онлайн, сериалы онлайн, новинки кино, онлайн бесплатно, в хорошем качестве, HD1080, HD720, FullHD')
@section('meta_description', 'Описание главной страницы')

@section('content')

<!--<big-swiper-component></big-swiper-component>-->
@if(count($films) || count($serials))
<div class="layout-loader">@include('frontend.components.loader')</div>
@endif
<div class="main-content">
    <div class="main-page-content">
        @if(count($films))
        <section class="main-page-slider">
            <div class="flex-row-center hidden">
                <h2 class="title">Новинки фильмов</h2>
                <div class="title main-color"><a href="{{route('type', 'films')}}" class=" link-underline">Смотреть все</a></div>
            </div>
            <swiper-component :videos="{{json_encode($films)}}" :route="{{json_encode(route('video'))}}"></swiper-component>
        </section>
        @endif
        @if(count($serials))
        <section class="main-page-slider">
            <div class="flex-row-center hidden">
                <h2 class="title">Новинки сериалов</h2>
                <div class="title main-color"><a href="{{route('type', 'serials')}}" class=" link-underline">Смотреть все</a></div>
            </div>
            <swiper-component :videos="{{json_encode($serials)}}" :route="{{json_encode(route('video'))}}"></swiper-component>
        </section>
        @endif
    </div>
</div>

@endsection
