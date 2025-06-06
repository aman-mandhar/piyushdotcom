<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏘️ Villa Details</h5>

    <!-- Villa Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Villa Type</label>
        <select wire:model.defer="villa.villa_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="Luxury">Luxury</option>
            <option value="Standard">Standard</option>
            <option value="Premium">Premium</option>
            <option value="Budget">Budget</option>
        </select>
        @error('villa.villa_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Area Size</label>
        <input type="text" wire:model.defer="villa.villa_area_size" class="form-control" placeholder="e.g. 2000">
        @error('villa.villa_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Unit -->
    <div class="col-md-2">
        <label class="form-label fw-semibold">Unit</label>
        <select wire:model.defer="villa.villa_area_units" class="form-select">
            <option value="Sq. Feet">Sq. Feet</option>
            <option value="Sq. Meters">Sq. Meters</option>
            <option value="Sq. Yards">Sq. Yards</option>
            <option value="Marla">Marla</option>
            <option value="Kanal">Kanal</option>
        </select>
        @error('villa.villa_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Facing -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Villa Facing</label>
        <select wire:model.defer="villa.villa_facing" class="form-select">
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
        @error('villa.villa_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
</div>
