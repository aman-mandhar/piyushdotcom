<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏢 Office Details</h5>

    <!-- Office Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Office Type</label>
        <select wire:model.defer="office.office_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="Co-working">Co-working</option>
            <option value="Private">Private</option>
            <option value="Shared">Shared</option>
            <option value="Virtual Office">Virtual Office</option>
            <option value="Executive Suite">Executive Suite</option>
        </select>
        @error('office.office_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Area Size</label>
        <input type="text" wire:model.defer="office.office_area_size" class="form-control" placeholder="e.g. 900">
        @error('office.office_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-2">
        <label class="form-label fw-semibold">Unit</label>
        <select wire:model.defer="office.office_area_units" class="form-select">
            <option value="Sq. Feet">Sq. Feet</option>
            <option value="Sq. Meters">Sq. Meters</option>
            <option value="Sq. Yards">Sq. Yards</option>
        </select>
        @error('office.office_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Floor Number -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Floor Number</label>
        <input type="text" wire:model.defer="office.floor_number" class="form-control" placeholder="e.g. Ground, 1st, 2A, etc.">
        @error('office.floor_number') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Office Facing -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Office Facing</label>
        <select wire:model.defer="office.office_facing" class="form-select">
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
        @error('office.office_facing') <span class="text-danger small">{{ $message }}</span> @enderror
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
