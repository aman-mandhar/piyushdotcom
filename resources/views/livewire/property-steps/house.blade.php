<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏠 House Details</h5>

    <!-- House Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">House Type</label>
        <select wire:model.defer="house.house_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="Independent">Independent</option>
            <option value="Duplex">Duplex</option>
            <option value="Triplex">Triplex</option>
            <option value="Builder Floor">Builder Floor</option>
            <option value="Other">Other</option>
        </select>
        @error('house.house_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Area Size</label>
        <input type="text" wire:model.defer="house.house_area_size" class="form-control" placeholder="e.g. 1800">
        @error('house.house_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-2">
        <label class="form-label fw-semibold">Unit</label>
        <select wire:model.defer="house.house_area_units" class="form-select">
            <option value="Sq. Feet">Sq. Feet</option>
            <option value="Sq. Meters">Sq. Meters</option>
            <option value="Sq. Yards">Sq. Yards</option>
            <option value="Marla">Marla</option>
            <option value="Kanal">Kanal</option>
        </select>
        @error('house.house_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">House Facing</label>
        <select wire:model.defer="house.house_facing" class="form-select">
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
        @error('house.house_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <!-- Furnishing Status -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">Furnishing Status</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Furnished', 'Semi-Furnished', 'Unfurnished'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="furnishing_status" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('furnishing_status') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
</div>
