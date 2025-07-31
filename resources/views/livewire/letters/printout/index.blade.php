@extends('layouts.print')
@section('content')
    {!! $letter->content !!}
    @include('livewire.shared.signature')
@endsection
