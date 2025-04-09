<div class="bg-white border border-light rounded p-4 shadow-sm mb-4">
    <h5 class="mb-4 fw-bold text-secondary">👤 Owner Information</h5>

    <div class="row">
        <!-- Row 1: Full width -->
        <div class="col-12 mb-3">
            <label class="form-label fw-semibold">Owner Name <span class="text-danger">*</span></label>
            <input type="text" wire:model="owner_name" placeholder="e.g. Aman Sharma" class="form-control">
            @error('owner_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Row 2 -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Owner Contact <span class="text-danger">*</span></label>
            <input type="text" wire:model="owner_contact" placeholder="e.g. +91 9876543210" class="form-control">
            @error('owner_contact') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Owner Email</label>
            <input type="email" wire:model="owner_email" placeholder="e.g. aman@email.com" class="form-control">
        </div>

        <!-- Row 3 -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Owner Address</label>
            <input type="text" wire:model="owner_address" placeholder="e.g. House No. 123, Model Town" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Owner Nationality</label>
            <select wire:model="owner_nationality" class="form-select">
                <option value="">Select</option>
                <option value="Indian">Indian</option>
                <option value="NRI">NRI</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Row 4 -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Owner Type</label>
            <select wire:model="owner_type" class="form-select">
                <option value="">Select</option>
                <option value="Individual">Individual</option>
                <option value="Broker">Broker</option>
                <option value="Investor">Investor</option>
                <option value="Builder">Builder</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Ownership Document</label>
            <select wire:model="owner_document_type" class="form-select">
                <option value="">Select</option>
                <option value="Registry">Registry</option>
                <option value="Kabza">Kabza</option>
                <option value="Power of Attorney">Power of Attorney</option>
                <option value="By Parent">By Parent</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>
</div>
