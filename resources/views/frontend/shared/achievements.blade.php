@extends('layouts.app')
@section('title')
    Our Achievements
@endsection
@section('content')
    @include('pages.partials.about.achievements')
    @include('cta.call-to-action')
    @include('pages.partials.partners')
    @include('pages.partials.stats')
@endsection
