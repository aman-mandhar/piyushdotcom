<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏡 Villa Details</h5>

    <!-- Villa Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Villa Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Luxury', 'Standard'] as $type)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="villa.villa_type" value="{{ $type }}">
                    <span>{{ $type }}</span>
                </label>
            @endforeach
        </div>
        @error('villa.villa_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="villa.villa_area_size" class="form-control" placeholder="e.g. 3000">
        @error('villa.villa_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-8">
        <h6 class="fw-semibold text-primary">Area Unit</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Sq. Feet', 'Sq. Meters', 'Sq. Yards', 'Marla', 'Kanal'] as $unit)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="villa.villa_area_units" value="{{ $unit }}">
                    <span>{{ $unit }}</span>
                </label>
            @endforeach
        </div>
        @error('villa.villa_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Facing</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'] as $face)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="villa.villa_facing" value="{{ $face }}">
                    <span>{{ $face }}</span>
                </label>
            @endforeach
        </div>
        @error('villa.villa_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Bedrooms, Bathrooms, Balconies, Floors -->
    @foreach([
        'villa_bedrooms' => 'Bedrooms',
        'villa_bathrooms' => 'Bathrooms',
        'villa_balconies' => 'Balconies',
        'villa_floors' => 'Total Floors'
    ] as $field => $label)
        <div class="col-md-6">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['1', '2', '3', '4', '5+'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="villa.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("villa.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Furnishing Status -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Furnishing Status</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Furnished', 'Semi-Furnished', 'Unfurnished'] as $option)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="villa.villa_furnishing_status" value="{{ $option }}">
                    <span>{{ $option }}</span>
                </label>
            @endforeach
        </div>
        @error('villa.villa_furnishing_status') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Swimming Pool / Garden / Parking -->
    @foreach([
        'villa_swimming_pool' => 'Swimming Pool',
        'villa_garden' => 'Garden',
        'villa_parking' => 'Parking'
    ] as $field => $label)
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Yes', 'No'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="villa.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("villa.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Advantage -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Advantage</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $val)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="villa.advantage" value="{{ $val }}">
                    <span>{{ $val }}</span>
                </label>
            @endforeach
        </div>
        @error('villa.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🖼️ Upload Villa Image</h6>
        <input type="file" wire:model="image" class="form-control">
        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
        <div wire:loading wire:target="image" class="text-muted small mt-2">Uploading...</div>
        @if ($image)
            <div class="mt-3 border rounded p-2">
                <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 280px;">
            </div>
        @endif
    </div>

    <!-- YouTube Video -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">📹 YouTube Video (Optional)</h6>
        <input type="url" wire:model.defer="video_link" class="form-control" placeholder="e.g. https://youtu.be/xyz123">
        @error('video_link') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
</div>
