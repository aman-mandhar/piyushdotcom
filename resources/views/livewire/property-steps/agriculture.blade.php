<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🌾 Agriculture Land Details</h5>

    <!-- Land Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Land Type</label>
        <select wire:model.defer="agriculture.land_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="Agriculture">Agriculture</option>
            <option value="Farm House">Farm House</option>
            <option value="Orchard">Orchard</option>
            <option value="Horticulture">Horticulture</option>
            <option value="Other">Other</option>
        </select>
        @error('agriculture.land_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Land Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Land Area Size</label>
        <input type="text" wire:model.defer="agriculture.land_area_size" class="form-control" placeholder="e.g. 5.25">
        @error('agriculture.land_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-2">
        <label class="form-label fw-semibold">Unit</label>
        <select wire:model.defer="agriculture.land_area_units" class="form-select">
            <option value="Feet">Feet</option>
            <option value="Meters">Meters</option>
            <option value="Yards">Yards</option>
            <option value="Marla">Marla</option>
            <option value="Kanal">Kanal</option>
            <option value="Kila">Kila</option>
            <option value="Bigha">Bigha</option>
            <option value="Acre">Acre</option>
        </select>
        @error('agriculture.land_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
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
</div>
