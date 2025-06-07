<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🌾 Agriculture Land Details</h5>

    <!-- Land Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Land Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Agriculture', 'Farm House', 'Other'] as $type)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="agriculture.land_type" value="{{ $type }}">
                    <span>{{ $type }}</span>
                </label>
            @endforeach
        </div>
        @error('agriculture.land_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="agriculture.land_area_size" class="form-control" placeholder="e.g. 2.5">
        @error('agriculture.land_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-8">
        <h6 class="fw-semibold text-primary">Area Unit</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Feet', 'Meters', 'Yards', 'Marla', 'Kanal', 'Kila', 'Bigha', 'Acre'] as $unit)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="agriculture.land_area_units" value="{{ $unit }}">
                    <span>{{ $unit }}</span>
                </label>
            @endforeach
        </div>
        @error('agriculture.land_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Facing</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'] as $face)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="agriculture.land_facing" value="{{ $face }}">
                    <span>{{ $face }}</span>
                </label>
            @endforeach
        </div>
        @error('agriculture.land_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Soil Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Soil Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Loamy', 'Clayey', 'Sandy', 'Saline', 'Peaty', 'Chalky'] as $soil)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="agriculture.land_soil_type" value="{{ $soil }}">
                    <span>{{ $soil }}</span>
                </label>
            @endforeach
        </div>
        @error('agriculture.land_soil_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Features -->
    @foreach([
        'land_irrigation' => 'Irrigation Available',
        'land_cultivation' => 'Currently Cultivated',
        'land_fencing' => 'Fencing Done',
        'land_boundary_wall' => 'Boundary Wall',
        'land_access_road' => 'Access Road',
        'land_power_supply' => 'Power Supply'
    ] as $field => $label)
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex gap-2">
                @foreach(['Yes', 'No'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="agriculture.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("agriculture.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Water Source -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Water Source</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Well', 'Tube Well', 'Canal', 'River', 'Borewell', 'Other'] as $source)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="agriculture.land_water_source" value="{{ $source }}">
                    <span>{{ $source }}</span>
                </label>
            @endforeach
        </div>
        @error('agriculture.land_water_source') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🖼️ Upload Land Image</h6>
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
