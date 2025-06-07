<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏭 Industrial Land Details</h5>

    <!-- Land Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Land Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Industrial', 'Warehouse', 'Factory'] as $type)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="industrial.land_type" value="{{ $type }}">
                    <span>{{ $type }}</span>
                </label>
            @endforeach
        </div>
        @error('industrial.land_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="industrial.land_area_size" class="form-control" placeholder="e.g. 10000">
        @error('industrial.land_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Unit -->
    <div class="col-md-8">
        <h6 class="fw-semibold text-primary">Area Unit</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Feet','Meters','Yards','Marla','Kanal','Kila','Bigha','Acre'] as $unit)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="industrial.land_area_units" value="{{ $unit }}">
                    <span>{{ $unit }}</span>
                </label>
            @endforeach
        </div>
        @error('industrial.land_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Land Facing</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['North','North-East','North-West','South','South-East','South-West','East','West','N/A'] as $face)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="industrial.land_facing" value="{{ $face }}">
                    <span>{{ $face }}</span>
                </label>
            @endforeach
        </div>
        @error('industrial.land_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Zone -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Land Zone</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Industrial','Commercial','Mixed Use'] as $zone)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="industrial.land_zone" value="{{ $zone }}">
                    <span>{{ $zone }}</span>
                </label>
            @endforeach
        </div>
        @error('industrial.land_zone') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Features -->
    @foreach([
        'land_access_road' => 'Access Road',
        'land_power_supply' => 'Power Supply',
        'land_water_supply' => 'Water Supply',
        'land_sewage_system' => 'Sewage System',
        'land_boundary_wall' => 'Boundary Wall',
        'land_fencing' => 'Fencing',
        'land_security' => 'Security',
        'land_cctv' => 'CCTV',
        'land_fire_safety' => 'Fire Safety',
        'land_railway_access' => 'Railway Access'
    ] as $field => $label)
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex gap-2">
                @foreach(['Yes', 'No'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="industrial.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("industrial.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Advantage -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Advantage</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $adv)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="industrial.advantage" value="{{ $adv }}">
                    <span>{{ $adv }}</span>
                </label>
            @endforeach
        </div>
        @error('industrial.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🖼️ Upload Image</h6>
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
