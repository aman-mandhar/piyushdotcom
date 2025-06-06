<style>
    .property-box {
        padding: 2rem;
        border-radius: 15px;
        border: 2px solid #dee2e6;
        background: #ffffff;
        box-shadow: 0 0 10px rgba(0,0,0,0.03);
    }
        .custom-radio-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        cursor: pointer;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .custom-radio-btn input[type="radio"] {
        display: none;
    }

    .custom-radio-btn input[type="radio"]:checked + span {
        background-color: #0d6efd;
        color: white;
        border-radius: 5px;
        padding: 0.4rem 1rem;
    }
</style>
<section class="property-box mb-5">
    <h5 class="fw-bold text-success mb-4">📋 Main Property Details</h5>

    <div class="row g-3">
        <!-- Title -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">Type suitable Title for your Property?</h6>
            <input type="text" wire:model.lazy="property_title" class="form-control" placeholder="e.g. Roadside Plot for Sale -- 3BHK House in City Center, etc.">
            <small class="form-text text-muted">This title will be used to attract buyers.</small>
            @error('property_title') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">Short Description of the Property</h6>
            <textarea wire:model.defer="description" rows="3" class="form-control" placeholder="Describe the property features, location, and any other important details...."></textarea>
            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Document Type -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">What type of document is available?</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Registry', 'Kabza', 'Power of Attorney', 'By Parent', 'Other'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="owner_document_type" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('owner_document_type') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">What is the current status of the property?</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Occupied', 'Vacant', 'Under Construction', 'Under Renovation', 'Under Dispute', 'Rented', 'Other'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="current_status" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('current_status') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Address -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">Full Address of Property</h6>
            <input type="text" wire:model="property_address" class="form-control" placeholder="Enter full address">
            @error('property_address') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Location -->
        <div class="col-md-6">
            <h6 class="fw-semibold text-primary">Nearby Landmark / Area</h6>
            <input type="text" wire:model="location" class="form-control" placeholder="e.g. Near Bus Stand, Model Town">
            @error('location') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- City -->
        <div class="col-md-6">
            <h6 class="fw-semibold text-primary">Select City</h6>
            <select wire:model="city_id" class="form-select">
                <option value="">-- Select --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Map Coordinates -->
        <div class="col-md-6">
            <h6 class="fw-semibold text-primary">Latitude (Map)</h6>
            <input type="text" wire:model.defer="latitude" class="form-control" placeholder="e.g. 30.9011">
            @error('latitude') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6">
            <h6 class="fw-semibold text-primary">Longitude (Map)</h6>
            <input type="text" wire:model.defer="longitude" class="form-control" placeholder="e.g. 75.8573">
            @error('longitude') <span class="text-danger small">{{ $message }}</span>@enderror
        </div>

        <!-- Price In -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">Choose Price Unit</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Thousand', 'Lakh', 'Crore', 'Million', 'Billion', 'Trillion'] as $unit)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="price_in" value="{{ $unit }}">
                        <span>{{ $unit }}</span>
                    </label>
                @endforeach
            </div>
            @error('price_in') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <!-- Price -->
        <div class="col-md-8">
            <h6 class="fw-semibold text-primary">Expected Price</h6>
            <input type="number" step="0.01" wire:model="price" class="form-control" placeholder="Enter expected price">
            @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>
</section>


