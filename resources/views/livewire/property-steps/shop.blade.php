<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🛍️ Shop Details</h5>

    <!-- Shop Type -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Shop Type</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['In Market', 'In Mall', 'Standalone', 'Other'] as $type)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="shop.shop_type" value="{{ $type }}">
                    <span>{{ $type }}</span>
                </label>
            @endforeach
        </div>
        @error('shop.shop_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="shop.shop_area_size" class="form-control" placeholder="e.g. 600">
        @error('shop.shop_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-8">
        <h6 class="fw-semibold text-primary">Area Unit</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Sq. Feet', 'Sq. Meters', 'Sq. Yards'] as $unit)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="shop.shop_area_units" value="{{ $unit }}">
                    <span>{{ $unit }}</span>
                </label>
            @endforeach
        </div>
        @error('shop.shop_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Shop Dimensions -->
    @foreach([
        'shop_front' => 'Front (ft)',
        'shop_back' => 'Back (ft)',
        'shop_side_1' => 'Left Side (ft)',
        'shop_side_2' => 'Right Side (ft)'
    ] as $field => $label)
        <div class="col-md-3">
            <label class="form-label fw-semibold text-primary">{{ $label }}</label>
            <input type="number" step="0.01" wire:model.defer="shop.{{ $field }}" class="form-control" placeholder="e.g. 12.5">
            @error("shop.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Floor Number -->
    <div class="col-md-3">
        <label class="form-label fw-semibold text-primary">Shop Floor</label>
        <input type="number" wire:model.defer="shop.shop_floor" class="form-control" placeholder="e.g. 1">
        @error('shop.shop_floor') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-9">
        <h6 class="fw-semibold text-primary">Shop Facing</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['North','North-East','North-West','South','South-East','South-West','East','West','N/A'] as $face)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="shop.shop_facing" value="{{ $face }}">
                    <span>{{ $face }}</span>
                </label>
            @endforeach
        </div>
        @error('shop.shop_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Advantage -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Advantage</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $option)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="shop.advantage" value="{{ $option }}">
                    <span>{{ $option }}</span>
                </label>
            @endforeach
        </div>
        @error('shop.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Features -->
    @foreach([
        'shop_security' => 'Security',
        'shop_parking' => 'Parking',
        'shop_air_conditioned' => 'Air Conditioned',
        'shop_power_backup' => 'Power Backup',
        'shop_water_supply' => 'Water Supply',
        'shop_toilet' => 'Toilet',
        'shop_storage' => 'Storage',
        'shop_cctv' => 'CCTV',
        'shop_fire_safety' => 'Fire Safety'
    ] as $field => $label)
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">{{ $label }}</h6>
            <div class="d-flex gap-2">
                @foreach(['Yes', 'No'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="shop.{{ $field }}" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
            @error("shop.$field") <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    @endforeach

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🖼️ Upload Shop Image</h6>
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
