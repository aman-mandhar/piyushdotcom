@extends('layouts.front.layout')
@section('title', $directory->name)

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="mb-4 border-bottom pb-2">
        <h2 class="fw-bold">{{ $directory->name }}</h2>
    </div>

    {{-- Details --}}
    <div class="row">
        <div class="col-md-7">
            <div class="mb-3">
                <h6 class="fw-semibold text-muted mb-1">📍 Address</h6>
                <p class="mb-2">{{ $directory->address }}</p>
            </div>

            <div class="mb-3">
                <h6 class="fw-semibold text-muted mb-1">🏙️ City</h6>
                <p class="mb-2">{{ $directory->city->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <h6 class="fw-semibold text-muted mb-1">🏢 Business Type</h6>
                @foreach(explode(',', $directory->business_type) as $type)
                    <span class="badge bg-primary me-1 mb-1">{{ trim($type) }}</span>
                @endforeach
            </div>
            <h5 class="fw-semibold mb-3">📞 Contact</h5>

        @auth
            @php $city_id = $directory->city_id; @endphp

            @if($directory->user_id === auth()->id())
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <p class="text-success mb-2">You created this listing.</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('directory.edit', $directory->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="{{ route('directory.destroy', $directory->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this entry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @else
                <form action="{{ route('calls.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="city_id" value="{{ $city_id }}">
                    <input type="hidden" name="directory_id" value="{{ $directory->id }}">
                    <input type="hidden" name="mobile" value="+919216051212">

                    <button type="submit" class="btn btn-success w-100 mt-3">
                        📞 Call Now
                    </button>
                </form>
            @endif
        @endauth
        </div>

        {{-- Video Embed --}}
        <div class="col-md-5">
            @php
                use Illuminate\Support\Str;

                $embedUrl = null;
                $url = $directory->video_link;

                if (!empty($url)) {
                    if (Str::contains($url, 'watch?v=')) {
                        parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
                        $embedUrl = 'https://www.youtube.com/embed/' . ($queryParams['v'] ?? '');
                    } elseif (Str::contains($url, 'youtu.be/')) {
                        $embedUrl = 'https://www.youtube.com/embed/' . last(explode('/', $url));
                    }
                }
            @endphp

            @if ($embedUrl)
                <div class="mb-3">
                    <h6 class="fw-semibold text-muted mb-2">🎥 Video Tour</h6>
                    <div class="ratio ratio-16x9 shadow-sm rounded">
                        <iframe src="{{ $embedUrl }}" title="Video Tour" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Contact Section --}}
    <div class="mt-5 p-4 bg-light border rounded">
        
    </div>
</div>
@endsection
