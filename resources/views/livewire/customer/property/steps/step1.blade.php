<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- Property Title -->
    <div>
        <label class="block font-semibold mb-1">Property Title</label>
        <input type="text" wire:model="property_title" class="w-full border rounded px-3 py-2" placeholder="Enter property title">
        @error('property_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Slug (readonly) -->
    <div>
        <label class="block font-semibold mb-1">Slug (Auto-generated)</label>
        <input type="text" wire:model="slug" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
        @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Owner Name -->
    <div>
        <label class="block font-semibold mb-1">Owner Name</label>
        <input type="text" wire:model="owner_name" class="w-full border rounded px-3 py-2">
        @error('owner_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Owner Contact -->
    <div>
        <label class="block font-semibold mb-1">Owner Contact</label>
        <input type="text" wire:model="owner_contact" class="w-full border rounded px-3 py-2">
        @error('owner_contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Owner Email -->
    <div>
        <label class="block font-semibold mb-1">Owner Email</label>
        <input type="email" wire:model="owner_email" class="w-full border rounded px-3 py-2">
    </div>

    <!-- Owner Address -->
    <div>
        <label class="block font-semibold mb-1">Owner Address</label>
        <input type="text" wire:model="owner_address" class="w-full border rounded px-3 py-2">
    </div>

    <!-- Owner Nationality -->
    <div>
        <label class="block font-semibold mb-1">Owner Nationality</label>
        <select wire:model="owner_nationality" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Indian">Indian</option>
            <option value="NRI">NRI</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Owner Type -->
    <div>
        <label class="block font-semibold mb-1">Owner Type</label>
        <select wire:model="owner_type" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Individual">Individual</option>
            <option value="Broker">Broker</option>
            <option value="Investor">Investor</option>
            <option value="Builder">Builder</option>
        </select>
    </div>

    <!-- Owner Document Type -->
    <div>
        <label class="block font-semibold mb-1">Ownership Document</label>
        <select wire:model="owner_document_type" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Registry">Registry</option>
            <option value="Kabza">Kabza</option>
            <option value="Power of Attorney">Power of Attorney</option>
            <option value="By Parent">By Parent</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Property Address -->
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1">Property Address</label>
        <input type="text" wire:model="property_address" class="w-full border rounded px-3 py-2">
        @error('property_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Court Case -->
    <div>
        <label class="block font-semibold mb-1">Court Case?</label>
        <select wire:model="court_case" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    <!-- Court Case Details -->
    <div>
        <label class="block font-semibold mb-1">Court Case Details</label>
        <input type="text" wire:model="court_case_details" class="w-full border rounded px-3 py-2">
    </div>

    <!-- Current Status -->
    <div>
        <label class="block font-semibold mb-1">Current Status</label>
        <select wire:model="current_status" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Occupied">Occupied</option>
            <option value="Vacant">Vacant</option>
            <option value="Under Construction">Under Construction</option>
            <option value="Under Renovation">Under Renovation</option>
            <option value="Under Dispute">Under Dispute</option>
            <option value="Rented">Rented</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Listing Type -->
    <div>
        <label class="block font-semibold mb-1">Listing Type</label>
        <select wire:model="listing_type" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Sale">Sale</option>
            <option value="Rent">Rent</option>
            <option value="Lease">Lease</option>
            <option value="Collaborate">Collaborate</option>
        </select>
        @error('listing_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Property Type -->
    <div>
        <label class="block font-semibold mb-1">Property Type</label>
        <select wire:model="property_type" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Plot">Plot</option>
            <option value="House">House</option>
            <option value="Apartment">Apartment</option>
            <option value="Villa">Villa</option>
            <option value="Office">Office</option>
            <option value="Shop">Shop</option>
            <option value="Agriculture Land">Agriculture Land</option>
        </select>
        @error('property_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Plot Category -->
    <div>
        <label class="block font-semibold mb-1">Plot Category</label>
        <select wire:model="plot_category" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
            <option value="Industrial">Industrial</option>
        </select>
    </div>

</div>
