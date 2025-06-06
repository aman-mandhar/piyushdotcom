<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🛍️ Shop Details</h5>

    <!-- Shop Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Shop Type</label>
        <select wire:model.defer="shop.shop_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="In Market">In Market</option>
            <option value="In Mall">In Mall</option>
            <option value="Standalone">Standalone</option>
            <option value="Other">Other</option>
        </select>
        @error('shop.shop_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Dimensions with AlpineJS for live area calculation -->
    <div class="col-md-12"
         x-data="{
            front: @entangle('shop.shop_front').defer,
            back: @entangle('shop.shop_back').defer,
            side1: @entangle('shop.shop_side_1').defer,
            side2: @entangle('shop.shop_side_2').defer,

            get area() {
                let f = parseFloat(this.front || 0);
                let b = parseFloat(this.back || 0);
                let s1 = parseFloat(this.side1 || 0);
                let s2 = parseFloat(this.side2 || 0);

                if (!f || !b || !s1 || !s2) return '';
                let avgWidth = (f + b) / 2;
                let avgDepth = (s1 + s2) / 2;
                return (avgWidth * avgDepth).toFixed(2);
            }
        }"
        x-effect="$wire.set('shop.shop_area_size', parseFloat(area))">

        <!-- Front -->
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Shop Front (ft)</label>
                <input type="number" step="0.01" x-model="front" class="form-control" placeholder="Front">
                @error('shop.shop_front') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Back -->
            <div class="col-md-3">
                <label class="form-label fw-semibold">Shop Back (ft)</label>
                <input type="number" step="0.01" x-model="back" class="form-control" placeholder="Back">
                @error('shop.shop_back') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Side 1 -->
            <div class="col-md-3">
                <label class="form-label fw-semibold">Side 1 (ft)</label>
                <input type="number" step="0.01" x-model="side1" class="form-control" placeholder="Left">
                @error('shop.shop_side_1') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Side 2 -->
            <div class="col-md-3">
                <label class="form-label fw-semibold">Side 2 (ft)</label>
                <input type="number" step="0.01" x-model="side2" class="form-control" placeholder="Right">
                @error('shop.shop_side_2') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Calculated Area Size (readonly) -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Shop Area Size (Sq. Ft.)</label>
        <input type="text"
            x-model="area"
            x-effect="$wire.set('shop.shop_area_size', parseFloat(area))"
            class="form-control bg-light"
            readonly>
        @error('shop.shop_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <div class="text-muted small">
        Livewire value: {{ $shop['shop_area_size'] ?? '' }}
    </div>


    <!-- Area Units -->
    <div class="col-md-2">
        <label class="form-label fw-semibold">Area Unit</label>
        <select wire:model.defer="shop.shop_area_units" class="form-select">
            <option value="Sq. Feet">Sq. Feet</option>
            <option value="Sq. Meters">Sq. Meters</option>
            <option value="Sq. Yards">Sq. Yards</option>
        </select>
        @error('shop.shop_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Floor Number -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Floor Number</label>
        <input type="number" wire:model.defer="shop.shop_floor" class="form-control" placeholder="e.g. 1">
        @error('shop.shop_floor') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

        <!-- Facing -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Land Facing</label>
        <select wire:model.defer="agriculture.land_facing" class="form-select">
            <option value="N/A">-- Select --</option>
            <option value="North">North</option>
            <option value="North-East">North-East</option>
            <option value="North-West">North-West</option>
            <option value="South">South</option>
            <option value="South-East">South-East</option>
            <option value="South-West">South-West</option>
            <option value="East">East</option>
            <option value="West">West</option>
        </select>
        @error('agriculture.land_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-4">
        <h5 class="fw-bold text-primary mb-3">🖼️ Upload Property Image</h5>

        <input type="file" wire:model="image" class="form-control">
        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

        <div wire:loading wire:target="image" class="text-muted small mt-2">Uploading...</div>

        @if ($image)
            <div class="mt-3 border rounded p-2">
                <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 280px;">
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Add YouTube Video (Optional)</h6>
        <input type="url" wire:model.defer="video_link" class="form-control" placeholder="e.g. https://youtu.be/xyz123">
        @error('video_link') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Advantage</label>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $option)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="plot.advantage" value="{{ $option }}">
                    <span>{{ $option }}</span>
                </label>
            @endforeach
        </div>
        @error('plot.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
</div>

