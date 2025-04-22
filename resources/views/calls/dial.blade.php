@extends('layouts.front.layout')

@section('title', 'Calling...')
@section('content')
<div class="container py-5 text-center">
    <h3>Dialing now...</h3>
    <p>If not redirected, <a id="callLink" href="tel:{{ $mobile }}">click here to call</a></p>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            document.getElementById("callLink").click();
        }, 500); // short delay before triggering call
    });
</script>
@endsection