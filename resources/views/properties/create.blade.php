@extends('layouts.front.layout')

@section('title', 'Add New Property')

@section('content')
    
@if (!Auth::check())
    {{-- Guest user --}}
    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
        🔐 Login to Add Property
    </button>
    <x-login-modal />
@else
    @livewire('create-property')
@endif
@endsection
