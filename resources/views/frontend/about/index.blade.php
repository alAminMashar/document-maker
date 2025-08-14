@extends('layouts.app')
@section('title')
    About Us
@endsection
@section('content')
    @include('home.partials.who-we-are')
    @include('home.partials.about-us')
    @include('about.partials.our-mission')
    @include('cta.call-to-action')
@endsection
