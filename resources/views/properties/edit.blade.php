@extends('layouts.front.layout')
@section('content')
<h2>Edit Property</h2>

<form action="{{ route('customer.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $property->title) }}" required>

    <select name="city_id" required>
        @foreach($cities as $city)
            <option value="{{ $city->id }}" {{ $property->city_id == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>

    <!-- Add other fields like in create form... -->
    <!-- Use value="{{ old('field', $property->field) }}" -->

    <button type="submit">Update Property</button>
</form>
@endsection