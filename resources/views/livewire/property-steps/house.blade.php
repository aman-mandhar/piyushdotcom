<div class="row g-3">
    <h5 class="mb-4 fw-bold text-secondary">🏠 House Details</h5>

    <!-- House Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold text-primary">House Type</label>
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
        <label class="form-label fw-semibold text-primary">Area Size</label>
        <input type="text" wire:model.defer="house.house_area_size" class="form-control" placeholder="e.g. 1800">
        @error('house.house_area_size') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Area Units -->
    <div class="col-md-2">
        <label class="form-label fw-semibold text-primary">Area Unit</label>
        <select wire:model.defer="house.house_area_units" class="form-select">
            <option value="">-- Unit --</option>
            <option value="Sq. Feet">Sq. Feet</option>
            <option value="Sq. Meters">Sq. Meters</option>
            <option value="Sq. Yards">Sq. Yards</option>
            <option value="Marla">Marla</option>
            <option value="Kanal">Kanal</option>
        </select>
        @error('house.house_area_units') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Construction Year -->
    <div class="col-md-6">
        <label class="form-label fw-semibold text-primary">Construction Year</label>
        <input type="date" wire:model.defer="house.construction_year" class="form-control">
        @error('house.construction_year') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Renovation Year -->
    <div class="col-md-6">
        <label class="form-label fw-semibold text-primary">Renovation Year</label>
        <input type="date" wire:model.defer="house.renovation_year" class="form-control">
        @error('house.renovation_year') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Bedrooms -->
    <div class="col-md-3">
        <label class="form-label fw-semibold text-primary">Bedrooms</label>
        <select wire:model.defer="house.house_bedrooms" class="form-select">
            <option value="">-- Select --</option>
            <option value="1">1</option><option value="2">2</option>
            <option value="3">3</option><option value="4">4</option>
            <option value="5+">5+</option>
        </select>
        @error('house.house_bedrooms') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Bathrooms -->
    <div class="col-md-3">
        <label class="form-label fw-semibold text-primary">Bathrooms</label>
        <select wire:model.defer="house.house_bathrooms" class="form-select">
            <option value="">-- Select --</option>
            <option value="1">1</option><option value="2">2</option>
            <option value="3">3</option><option value="4">4</option>
            <option value="5+">5+</option>
        </select>
        @error('house.house_bathrooms') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Balconies -->
    <div class="col-md-3">
        <label class="form-label fw-semibold text-primary">Balconies</label>
        <select wire:model.defer="house.house_balconies" class="form-select">
            <option value="">-- Select --</option>
            <option value="1">1</option><option value="2">2</option>
            <option value="3">3</option><option value="4">4</option>
            <option value="5+">5+</option>
        </select>
        @error('house.house_balconies') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Floors -->
    <div class="col-md-3">
        <label class="form-label fw-semibold text-primary">Floors</label>
        <select wire:model.defer="house.house_floors" class="form-select">
            <option value="">-- Select --</option>
            <option value="1">1</option><option value="2">2</option>
            <option value="3">3</option><option value="4">4</option>
            <option value="5+">5+</option>
        </select>
        @error('house.house_floors') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- House Facing -->
    <div class="col-md-6">
        <label class="form-label fw-semibold text-primary">House Facing</label>
        <select wire:model.defer="house.house_facing" class="form-select">
            <option value="N/A">-- Select --</option>
            <option value="North">North</option><option value="North-East">North-East</option>
            <option value="North-West">North-West</option><option value="South">South</option>
            <option value="South-East">South-East</option><option value="South-West">South-West</option>
            <option value="East">East</option><option value="West">West</option>
        </select>
        @error('house.house_facing') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Furnishing Status -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">Furnishing Status</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Furnished', 'Semi-Furnished', 'Unfurnished'] as $option)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="house.house_furnishing_status" value="{{ $option }}">
                    <span>{{ $option }}</span>
                </label>
            @endforeach
        </div>
        @error('house.house_furnishing_status') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Advantage -->
    <div class="col-md-12">
        <h6 class="fw-semibold text-primary">Advantage</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $option)
                <label class="custom-radio-btn">
                    <input type="radio" wire:model.defer="house.advantage" value="{{ $option }}">
                    <span>{{ $option }}</span>
                </label>
            @endforeach
        </div>
        @error('house.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Image Upload -->
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary">🏞️ Upload House Image</h6>
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
