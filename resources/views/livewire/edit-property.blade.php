<!-- Property Form Card -->
<div class="container my-4">
    <div class="card shadow-sm border rounded">
        <div class="card-header bg-success text-white fw-bold fs-5">
            🏡 Edit your Property
        </div>

        <div class="card-body p-4">    
        <!-- Form Content -->
        <section class="md:w-3/4 w-full bg-white shadow-sm p-6 rounded-md border">
            <form wire:submit.prevent="updateProperty" class="roperty space-y-6">
                <div class="flex justify-between items-center mt-6">
                    
                </div>
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
                    <div class="row g-4">
                        <h5 class="mb-4 fw-bold text-secondary">📋 Basic Info</h5>
                        <!-- Property Title -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Property Title</label>
                            <input type="text" wire:model="property_title" class="form-control shadow-sm" placeholder="Enter property title">
                            @error('property_title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address of Property</label>
                            <input type="text" wire:model="property_address" class="form-control bg-light">
                        </div>

                        <!--Court Case -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">If any Court Case</label>
                            <select wire:model="court_case" class="form-select shadow-sm">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            @error('court_case') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Case Details -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Court Case Details</label>
                            <input type="text" wire:model="court_case_details" class="form-control shadow-sm">
                            @error('court_case_details') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Current Status 'Occupied','Vacant','Under Construction','Under Renovation','Under Dispute','Rented','Other' -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Current Status of Property</label>
                            <select wire:model="current_status" class="form-select shadow-sm">
                                <option value="">Select</option>
                                <option value="Occupied">Occupied</option>
                                <option value="Vacant">Vacant</option>
                                <option value="Under Construction">Under Construction</option>
                                <option value="Under Renovation">Under Renovation</option>
                                <option value="Under Dispute">Under Dispute</option>
                                <option value="Rented">Rented</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('current_status') <small class="text-danger">{{ $message }}</small> @enderror
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
                </div>
                <div class="container-fluid">
                    
                    {{-- Plot Fields --}}
                    @if ($property_type === 'Plot')
                    <h5 class="mb-4 fw-bold text-secondary">🗺️ Plot Details</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Plot Category</label>
                                <select wire:model="plot_category" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">Industrial</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Measurement Unit</label>
                                <select wire:model="measurement_unit" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Sq. Feet">Sq. Feet</option>
                                    <option value="Sq. Yard">Sq. Yard</option>
                                    <option value="Sq. Meter">Sq. Meter</option>
                                    <option value="Sq. Acre">Sq. Acre</option>
                                    <option value="Sq. Marla">Sq. Marla</option>
                                    <option value="Sq. Bigha">Sq. Bigha</option>
                                    <option value="Sq. Kanal">Sq. Kanal</option>
                                </select>
                            </div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Plot Type</label><select wire:model="plot_type" class="form-control">
                                <option value="">Select</option>
                                <option value="Corner">Corner</option>
                                <option value="On Road">On Road</option>
                                <option value="Park Facing">Park Facing</option>
                                <option value="Normal">Normal</option>
                            </select></div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Plot Number</label>
                                <input type="text" wire:model="plot_number" class="form-control">
                            </div>
                            <div 
                                x-data="{
                                    front: @entangle('plot_front').defer,
                                    back: @entangle('plot_back').defer,
                                    side1: @entangle('plot_side_1').defer,
                                    side2: @entangle('plot_side_2').defer,
                                    get area() {
                                        let avgWidth = (parseFloat(this.front || 0) + parseFloat(this.back || 0)) / 2;
                                        let avgDepth = (parseFloat(this.side1 || 0) + parseFloat(this.side2 || 0)) / 2;
                                        return (avgWidth * avgDepth).toFixed(2);
                                    }
                                }"
                                class="row g-3"
                            >
                                <!-- Front -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Front</label>
                                    <input type="number" x-model="front" class="form-control" step="0.01">
                                </div>

                                <!-- Back -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Back</label>
                                    <input type="number" x-model="back" class="form-control" step="0.01">
                                </div>

                                <!-- Side 1 -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Side 1</label>
                                    <input type="number" x-model="side1" class="form-control" step="0.01">
                                </div>

                                <!-- Side 2 -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Side 2</label>
                                    <input type="number" x-model="side2" class="form-control" step="0.01">
                                </div>

                                <!-- Calculated Area (Live Display + Binding to Livewire) -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Total Area (auto)</label>
                                    <input type="text" x-bind:value="area" x-effect="$wire.plot_size = area" class="form-control bg-light" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Price Per Sq. Ft. If applicable</label>
                                <input type="number" wire:model="price_per_sqft" class="form-control" step="0.01">
                            </div>
                        </div>
                    @endif
                
                    {{-- House / Apartment / Villa --}}
                    @if (in_array($property_type, ['House', 'Apartment', 'Villa']))
                    <h5 class="mb-4 fw-bold text-secondary">🏠 Property Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label fw-semibold">Bedrooms</label><input type="number" wire:model="bedrooms" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Bathrooms</label><input type="number" wire:model="bathrooms" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Balconies</label><input type="number" wire:model="balconies" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Floor Number<i>(for flats only)</i></label><input type="number" wire:model="floor_number" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Total Builtup Floors</label><input type="number" wire:model="total_floors" class="form-control"></div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Furnishing Status</label>
                                <select wire:model="furnishing_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-Furnished">Semi-Furnished</option>
                                    <option value="Unfurnished">Unfurnished</option>
                                </select>
                            </div>
                        </div>
                    @endif
                
                    {{-- Office --}}
                    @if ($property_type === 'Office')
                    <h5 class="mb-4 fw-bold text-secondary">🏢 Office Space Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label fw-semibold">At Floor No.</label><input type="number" wire:model="office_floor" class="form-control"></div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Furnishing Status</label>
                                <select wire:model="office_furnishing_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-Furnished">Semi-Furnished</option>
                                    <option value="Unfurnished">Unfurnished</option>
                                </select>
                            </div><div class="col-md-6"><label class="form-label fw-semibold">Bathrooms</label><input type="number" wire:model="office_bathrooms" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Balconies</label><input type="number" wire:model="office_balconies" class="form-control"></div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Office Area Unit</label>
                                <select wire:model="office_area_size_unit" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Sq. Feet">Sq. Feet</option>
                                    <option value="Sq. Meters">Sq. Meters</option>
                                    <option value="Sq. Yards">Sq. Yards</option>
                                </select>
                            </div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Office Area Size</label><input type="number" wire:model="office_area_size" step="0.01" class="form-control"></div>
                            
                        </div>
                    @endif
                
                    {{-- Shop --}}
                    @if ($property_type === 'Shop')
                    <h5 class="mb-4 fw-bold text-secondary">🛒 Shop Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Shop Type</label>
                                <select wire:model="shop_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="In Market">In Market</option>
                                    <option value="In Mall">In Mall</option>
                                    <option value="Standalone">Standalone</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Shop Area Unit</label>
                                <select wire:model="shop_area_size_unit" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Sq. Feet">Sq. Feet</option>
                                    <option value="Sq. Meters">Sq. Meters</option>
                                    <option value="Sq. Yards">Sq. Yards</option>
                                </select>
                            </div>
                            <div 
                                x-data="{
                                    front: @entangle('shop_front').defer,
                                    back: @entangle('shop_back').defer,
                                    side1: @entangle('shop_side_1').defer,
                                    side2: @entangle('shop_side_2').defer,
                                    get area() {
                                        let avgWidth = (parseFloat(this.front || 0) + parseFloat(this.back || 0)) / 2;
                                        let avgDepth = (parseFloat(this.side1 || 0) + parseFloat(this.side2 || 0)) / 2;
                                        return (avgWidth * avgDepth).toFixed(2);
                                    }
                                }"
                                class="row g-3">
                                <!-- Shop Front -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Front</label>
                                    <input type="number" x-model="front" class="form-control">
                                </div>

                                <!-- Shop Back -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Back</label>
                                    <input type="number" x-model="back" class="form-control">
                                </div>

                                <!-- Shop Side 1 -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Side 1</label>
                                    <input type="number" x-model="side1" class="form-control">
                                </div>

                                <!-- Shop Side 2 -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Side 2</label>
                                    <input type="number" x-model="side2" class="form-control">
                                </div>

                                <!-- Auto Calculated Area -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Shop Area (auto)</label>
                                    <input type="text" x-bind:value="area" x-effect="$wire.shop_area_size = area" class="form-control bg-light" readonly>
                                </div>
                            </div>
                        <div class="col-md-6"><label class="form-label fw-semibold">At Floor No.</label><input type="number" wire:model="shop_floor" class="form-control"></div>
                            <div class="col-md-12 d-flex align-items-center mt-2">
                                <input type="checkbox" wire:model="shop_with_water_connection" id="water" class="form-check-input me-2">
                                <label for="water" class="form-check-label">Water Connection Available</label>
                            </div>
                        </div>
                    @endif
                
                    {{-- Agriculture Land --}}
                    @if ($property_type === 'Agriculture Land')
                    <h5 class="mb-4 fw-bold text-secondary">🌿 Details of Agriculture Land</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Land Type</label>
                                <select wire:model="land_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Farm House">Farm House</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Land Area Unit</label>
                                <select wire:model="land_area_size_unit" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Meters">Meters</option>
                                    <option value="Yards">Yards</option>
                                    <option value="Marla">Marla</option>
                                    <option value="Kanal">Kanal</option>
                                    <option value="Kila">Kila</option>
                                    <option value="Bigha">Bigha</option>
                                    <option value="Acre">Acre</option>
                                </select>
                            </div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Area Size</label><input type="number" wire:model="land_area_size" class="form-control"></div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Current Status</label>
                                <select wire:model="current_status_of_land" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Cultivated">Cultivated</option>
                                    <option value="Vacant">Vacant</option>
                                    <option value="Under Dispute">Under Dispute</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="container-fluid">
                    <h5 class="mb-4 fw-bold text-secondary">📍 Location & Pricing</h5>
                    <div class="row g-3">
                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <select wire:model="city_id" class="form-control">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                
                        <!-- Location -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Location (Locality)</label>
                            <input type="text" wire:model="location" class="form-control">
                            @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!--Price In -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Price In</label>
                            <select wire:model="price_in" class="form-control">
                                <option value="">Select</option>
                                <option value="Lakh">Lakh</option>
                                <option value="Crore">Crore</option>
                                <option value="Thousand">Thousand</option>
                                <option value="Million">Million</option>
                                <option value="Billion">Billion</option>
                                <option value="Trillion">Trillion</option>
                            </select>
                            @error('price_in') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                
                        <!-- Price -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Price</label>
                            <input type="number" wire:model="price" step="0.01" class="form-control">
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                
                        <!-- Negotiable -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Is it Negotiable</label>
                            <select wire:model="negotiable_price" class="form-control">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <!--Market Price -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Current Market Price</label>
                            <input type="number" wire:model="market_price" step="0.01" class="form-control">
                            @error('market_price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                
                        <!-- Facing -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Front Facing</label>
                            <select wire:model="facing" class="form-control">
                                <option value="">Select</option>
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction }}">{{ $direction }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Total Area (Label Based) -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Total Area</label>
                            <input type="text" wire:model="area" class="form-control" placeholder="e.g. 1200 Sq. Ft.">
                        </div>

                        <!-- Area Unit -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Total Area Unit</label>
                            <select wire:model="area_unit" class="form-control">
                                <option value="">Select</option>
                                <option value="Sq. Feet">Sq. Feet</option>
                                <option value="Sq. Meters">Sq. Meters</option>
                                <option value="Sq. Yards">Sq. Yards</option>
                                <option value="Acres">Acres</option>
                                <option value="Hectares">Hectares</option>
                                <option value="Bigha">Bigha</option>
                                <option value="Kanal">Kanal</option>
                                <option value="Marla">Marla</option>
                                <option value="Kila">Kila</option>
                            </select>
                        </div>
                
                        <!-- Hospital Distance -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nearest Hospital (Distance in km)</label>
                            <input type="text" wire:model="hospital_distance" class="form-control" placeholder="e.g. 2 km">
                        </div>
                
                        <!-- Railway Station Distance -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nearest Railway Station (Distance in km)</label>
                            <input type="text" wire:model="railway_distance" class="form-control" placeholder="e.g. 5 km">
                        </div>
                
                        <!-- Public Transport -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Public Transport (Distance in km)</label>
                            <input type="text" wire:model="transport_distance" class="form-control" placeholder="e.g. 500 m">
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <h5 class="mb-4 fw-bold text-secondary">📸 Media & Description</h5>
                    <div class="row g-3">
                
                        <!-- Thumbnail Upload -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Image</label>
                            {{-- Existing thumbnail preview --}}
                            <p><img src="{{ asset('storage/' . $current_image) }}"
                                class="img-thumbnail rounded shadow-sm"
                                style="max-width: 150px;"
                                alt="Current Thumbnail"></p>
                            {{-- File input --}}
                            <label class="form-label fw-semibold">Replace with New Image?</label>
                            <input type="file" wire:model="image" class="form-control mt-2">

                            {{-- Show new image preview if selected --}}
                            @if ($image instanceof \Livewire\TemporaryUploadedFile)
                                <div class="mt-3">
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="img-thumbnail rounded shadow-sm"
                                        style="max-width: 150px;"
                                        alt="Preview">
                                    <p class="text-muted small mt-1">New preview (not yet saved)</p>
                                </div>
                            @endif

                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>


                
                        <!-- Media Tips -->
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="bg-warning bg-opacity-25 border-start border-4 border-warning px-3 py-2 rounded w-100">
                                <strong class="text-warning">Tip:</strong> Upload clear and well-lit images to attract more buyers.
                            </div>
                        </div>
                
                        <!-- Property Description -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Property Description</label>
                            <textarea wire:model="description" rows="5" class="form-control" placeholder="Describe your property..."></textarea>
                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <!-- Video Link -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Video Link (YouTube)</label>
                            <input type="text" wire:model="video_link" class="form-control" placeholder="e.g. https://www.youtube.com/watch?v=example">
                            @error('video_link') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                    </div>
                </div>
                <button type="submit">Submit Property</button>
            </form>
        </section>
        </div>
    </div>
</div>

