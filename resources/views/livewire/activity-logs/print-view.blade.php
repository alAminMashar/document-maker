@extends('layouts.print')
@section('content')
    @if (isset($logs))
        @include('livewire.activity-logs.document-partials.doc-header')
        @include('livewire.activity-logs.document-partials.table')
    @endif
@endsection
