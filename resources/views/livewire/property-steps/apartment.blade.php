<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏢 Apartment Details</h5>

    <!-- Apartment Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Apartment Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['1BHK','2BHK','3BHK','4BHK','Studio','Penthouse'] as $type)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="apartment.apartment_type" value="{{ $type }}">
                    <span>{{ $type }}</span>
                </label>
            @endforeach
        </div>
        @error('apartment.apartment_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area -->
    <div class="col-md-4">
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="apartment.apartment_area_size" class="form-control" placeholder="e.g. 1200">
        @error('apartment.apartment_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-8">
        <h6 class="fw-semibold text-primary">Area Unit</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Sq. Feet', 'Sq. Meters', 'Sq. Yards', 'Marla', 'Kanal'] as $unit)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="apartment.apartment_area_units" value="{{ $unit }}">
                    <span>{{ $unit }}</span>
                </label>
            @endforeach
        </div>
        @error('apartment.apartment_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Floor -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Floor</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Ground','1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th'] as $floor)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="apartment.apartment_floor" value="{{ $floor }}">
                    <span>{{ $floor }}</span>
                </label>
            @endforeach
        </div>
        @error('apartment.apartment_floor') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Bedrooms, Bathrooms, Balconies, Floors -->
    @foreach ([
        'apartment_bedrooms' => 'Bedrooms',
        'apartment_bathrooms' => 'Bathrooms',
        'apartment_balconies' => 'Balconies',
        'apartment_floors' => 'Total Floors'
    ] as $field => $label)
        <div class="col-md-6">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['1','2','3','4','5+'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="apartment.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("apartment.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Apartment View -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">Apartment View</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Park','Road','City','Sea','Mountain','Garden','Pool','Other'] as $view)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="apartment.apartment_view" value="{{ $view }}">
                    <span>{{ $view }}</span>
                </label>
            @endforeach
        </div>
        @error('apartment.apartment_view') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">Facing</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['North','North-East','North-West','South','South-East','South-West','East','West','N/A'] as $face)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="apartment.apartment_facing" value="{{ $face }}">
                    <span>{{ $face }}</span>
                </label>
            @endforeach
        </div>
        @error('apartment.apartment_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- YES/NO Amenities -->
    @foreach([
        'apartment_security' => 'Security',
        'apartment_elevator' => 'Elevator',
        'apartment_parking' => 'Parking',
        'apartment_power_backup' => 'Power Backup',
        'apartment_water_supply' => 'Water Supply',
        'apartment_gas_supply' => 'Gas Supply',
        'apartment_waste_management' => 'Waste Management',
        'apartment_gym' => 'Gym',
        'apartment_swimming_pool' => 'Swimming Pool',
        'apartment_clubhouse' => 'Clubhouse',
        'apartment_play_area' => 'Play Area',
        'apartment_security_guard' => 'Security Guard',
        'apartment_fire_safety' => 'Fire Safety',
        'apartment_cctv' => 'CCTV',
        'apartment_intercom' => 'Intercom'
    ] as $field => $label)
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex gap-2">
                @foreach(['Yes', 'No'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="apartment.{{ $field }}" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error("apartment.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🖼️ Upload Apartment Image</h6>
        <input type="file" wire:model="image" class="form-control">
        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
        <div wire:loading wire:target="image" class="text-muted small mt-2">Uploading...</div>
        @if ($image)
            <div class="mt-3 border rounded p-2">
                <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 280px;">
            </div>
        @endif
    </div>

    <!-- Video Link -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">📹 YouTube Video (Optional)</h6>
        <input type="url" wire:model.defer="video_link" class="form-control" placeholder="e.g. https://youtu.be/xyz123">
        @error('video_link') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
</div>
