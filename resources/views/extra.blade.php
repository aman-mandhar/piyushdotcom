<!-- Sidebar: Contact Info -->
<div class="col-md-4">
    <div class="card p-4 shadow">
        <h5 class="mb-3">Contact Seller</h5>
        <p><strong>Name:</strong> {{ $property->user->name }}</p>
        <p><strong>City:</strong> {{ $property->user->city->name }}</p>
        @php
            $user = Auth::user();
        @endphp
        @if($user == null)
            <h6>
                <div class="text-danger">Login to see the contact details</div>
            </h6>
            <div class="mt-3">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                <span>New User <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 mt-2">FREE SignUp!</a></span>
            </div>
        @else
        @auth
            @php
                $city_id = $property->city_id;
            @endphp
            @if($property->user_id == auth()->user()->id)
                <div class="mt-auto d-flex justify-content-between align-items-center">
                    <p class="text-success">This Property is created by you.</p>
                    <a href="{{ route('properties.edit', $property->slug) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form action="{{ route('properties.destroy', $property->slug) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this property?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            @else
                <form action="{{ route('calls.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="city_id" value="{{ $city_id }}">
                
                    @if(isset($property))
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="mobile" value="+919216051212">
                    @elseif(isset($vehicle))
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                        <input type="hidden" name="mobile" value="+919216051212">
                    @elseif(isset($directory))
                        <input type="hidden" name="directory_id" value="{{ $directory->id }}">
                        <input type="hidden" name="mobile" value="+919216051212">
                    @endif
                
                    <button type="submit" class="btn btn-outline-success w-100 mt-2">📞 Call Now</button>
                </form>
            @endif
                {{-- OR Option B: Modal trigger --}}
                {{-- <a href="#" class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#authModal">Login to Contact</a> --}}
        @endauth
        @endif
    </div>
    <!-- Displaying the youtube video if available -->
    <div class="card p-4 mt-4">
        <h5 class="mb-3">Video Tour</h5>
        @php
            use Illuminate\Support\Str;

            $embedUrl = null;

            if (!empty($property->video_link)) {
                $url = $property->video_link;

                // Check for full YouTube link
                if (Str::contains($url, 'watch?v=')) {
                    $parsed = parse_url($url);
                    parse_str($parsed['query'] ?? '', $queryParams);
                    if (!empty($queryParams['v'])) {
                        $embedUrl = 'https://www.youtube.com/embed/' . $queryParams['v'];
                    }
                }

                // Check for short youtu.be link
                if (Str::contains($url, 'youtu.be/')) {
                    $segments = explode('/', $url);
                    $videoId = end($segments);
                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                }
            }
        @endphp

        @if ($embedUrl)
            <div class="card p-4 mt-4">
                <h5 class="mb-3">🎥 Video Tour</h5>
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $embedUrl }}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        @endif
    </div>
</div>
</div>