@extends('layouts.app')
@section('title')
    {{ config('app.tagline') }} | Home
@endsection
@section('content')
    @include('home.partials.landing')
    @include('home.partials.who-we-are')
    @include('home.partials.about-us')
    @include('home.partials.property-preview')
    @include('home.partials.services')
    @include('home.partials.why-us')
    @include('cta.call-to-action')
@endsection
