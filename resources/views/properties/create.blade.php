@extends('layouts.front.layout')

@section('title', 'Add New Property')

@section('content')

@guest
    <x-login-modal />
    <x-register-modal />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
@endguest

@auth
    @livewire('create-property')
@endauth

@endsection
