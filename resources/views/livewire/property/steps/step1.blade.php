<div class="row g-4">
    <!-- Property Title -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Property Title</label>
        <input type="text" wire:model="property_title" class="form-control shadow-sm" placeholder="Enter property title">
        @error('property_title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Slug -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Slug (Auto-generated)</label>
        <input type="text" wire:model="slug" class="form-control bg-light" readonly>
    </div>

    <!-- Listing Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Listing Type</label>
        <select wire:model="listing_type" class="form-select shadow-sm">
            <option value="">Select</option>
            <option value="Sale">Sale</option>
            <option value="Rent">Rent</option>
            <option value="Lease">Lease</option>
            <option value="Collaborate">Collaborate</option>
        </select>
        @error('listing_type') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Property Type -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Property Type</label>
        <select wire:model.lazy="property_type" class="form-select shadow-sm">
            <option value="">Select</option>
            <option value="Plot">Plot</option>
            <option value="House">House</option>
            <option value="Apartment">Apartment</option>
            <option value="Villa">Villa</option>
            <option value="Office">Office</option>
            <option value="Shop">Shop</option>
            <option value="Agriculture Land">Agriculture Land</option>
        </select>
        @error('property_type') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

