@extends('layouts.front.layout')

@section('title', 'Add New Property')

@section('content')

@guest
    <x-login-modal />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
            myModal.show();
        });
    </script>
@endguest

@auth
    @livewire('create-property')
@endauth

@endsection
