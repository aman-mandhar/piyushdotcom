<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏢 Office Details</h5>

    <!-- Office Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Office Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Co-working', 'Private', 'Shared'] as $type)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="office.office_type" value="{{ $type }}">
                    <span>{{ $type }}</span>
                </label>
            @endforeach
        </div>
        @error('office.office_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area -->
    <div class="col-md-4">
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="office.office_area_size" class="form-control" placeholder="e.g. 800">
        @error('office.office_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-8">
        <h6 class="fw-semibold text-primary">Area Unit</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Sq. Feet', 'Sq. Meters', 'Sq. Yards'] as $unit)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="office.office_area_units" value="{{ $unit }}">
                    <span>{{ $unit }}</span>
                </label>
            @endforeach
        </div>
        @error('office.office_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Floor Number -->
    <div class="col-md-6">
        <label class="form-label fw-semibold text-primary">Floor Number</label>
        <input type="text" wire:model.defer="office.floor_number" class="form-control" placeholder="e.g. 3rd Floor">
        @error('office.floor_number') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">Facing</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['North','North-East','North-West','South','South-East','South-West','East','West','N/A'] as $face)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="office.office_facing" value="{{ $face }}">
                    <span>{{ $face }}</span>
                </label>
            @endforeach
        </div>
        @error('office.office_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Furnishing -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Furnishing Status</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Furnished', 'Semi-Furnished', 'Unfurnished'] as $furnish)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="office.office_furnishing_status" value="{{ $furnish }}">
                    <span>{{ $furnish }}</span>
                </label>
            @endforeach
        </div>
        @error('office.office_furnishing_status') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Features (Yes/No) -->
    @foreach([
        'office_air_conditioned' => 'Air Conditioned',
        'office_meeting_room' => 'Meeting Room',
        'office_security' => 'Security',
        'office_parking' => 'Parking',
        'office_internet' => 'Internet',
        'office_power_backup' => 'Power Backup',
        'office_cctv' => 'CCTV',
        'office_fire_safety' => 'Fire Safety',
        'office_reception' => 'Reception',
        'office_kitchen' => 'Kitchen',
        'office_toilet' => 'Toilet',
        'office_storage' => 'Storage Room'
    ] as $field => $label)
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex gap-2">
                @foreach(['Yes', 'No'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="office.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("office.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🖼️ Upload Office Image</h6>
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
