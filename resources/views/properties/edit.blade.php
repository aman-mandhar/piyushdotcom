@extends('layouts.front.layout')
@section('content')
@livewire('edit-property', ['id' => $property->id])
@endsection