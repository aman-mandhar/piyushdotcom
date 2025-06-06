<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏭 Industrial Land Details</h5>

    <!-- Land Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Land Type</label>
        <select wire:model.defer="industrial.land_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="Industrial">Industrial</option>
            <option value="Warehouse">Warehouse</option>
            <option value="Factory">Factory</option>
            <option value="Logistics">Logistics</option>
            <option value="Other">Other</option>
        </select>
        @error('industrial.land_type') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Land Area Size -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Land Area Size</label>
        <input type="text" wire:model.defer="industrial.land_area_size" class="form-control" placeholder="e.g. 10.5">
        @error('industrial.land_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-2">
        <label class="form-label fw-semibold">Unit</label>
        <select wire:model.defer="industrial.land_area_units" class="form-select">
            <option value="Feet">Feet</option>
            <option value="Meters">Meters</option>
            <option value="Yards">Yards</option>
            <option value="Marla">Marla</option>
            <option value="Kanal">Kanal</option>
            <option value="Kila">Kila</option>
            <option value="Bigha">Bigha</option>
            <option value="Acre">Acre</option>
        </select>
        @error('industrial.land_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
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
