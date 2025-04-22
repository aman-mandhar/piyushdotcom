@extends('layouts.front.layout')
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Vehicle</h2>
    @livewire('vehicle.edit', ['vehicle' => $vehicle])
</div>
@endsection