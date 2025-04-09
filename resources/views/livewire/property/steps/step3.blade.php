<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Plot Fields --}}
    @if ($property_type === 'Plot')
        <div>
            <label class="block font-semibold mb-1">Plot Category</label>
            <select wire:model="plot_category" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Residential">Residential</option>
                <option value="Commercial">Commercial</option>
                <option value="Industrial">Industrial</option>
            </select>
        </div>
        <div>
            <label>Measurement Unit</label>
            <select wire:model="measurement_unit" class="w-full border rounded px-3 py-2">
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
        <div><label>Plot Type</label><select wire:model="plot_type" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="Corner">Corner</option>
            <option value="On Road">On Road</option>
            <option value="Park Facing">Park Facing</option>
            <option value="Normal">Normal</option>
        </select></div>
        <div><label>Plot Number</label><input type="text" wire:model="plot_number" class="w-full border rounded px-3 py-2"></div>
        <div><label>Front</label><input type="number" wire:model="plot_front" class="w-full border rounded px-3 py-2" step="0.01"></div>
        <div><label>Back</label><input type="number" wire:model="plot_back" class="w-full border rounded px-3 py-2" step="0.01"></div>
        <div><label>Side 1</label><input type="number" wire:model="plot_side_1" class="w-full border rounded px-3 py-2" step="0.01"></div>
        <div><label>Side 2</label><input type="number" wire:model="plot_side_2" class="w-full border rounded px-3 py-2" step="0.01"></div>
        <div><label>Total Area (auto)</label><input type="text" wire:model="plot_size" readonly class="w-full border rounded px-3 py-2 bg-gray-100"></div>
        <div><label>Price Per Sq. Ft.</label><input type="number" wire:model="price_per_sqft" class="w-full border rounded px-3 py-2" step="0.01"></div>
    @endif

    {{-- House / Apartment / Villa --}}
    @if (in_array($property_type, ['House', 'Apartment', 'Villa']))
        <div><label>Bedrooms</label><input type="number" wire:model="bedrooms" class="w-full border rounded px-3 py-2"></div>
        <div><label>Bathrooms</label><input type="number" wire:model="bathrooms" class="w-full border rounded px-3 py-2"></div>
        <div><label>Balconies</label><input type="number" wire:model="balconies" class="w-full border rounded px-3 py-2"></div>
        <div><label>Floor Number</label><input type="number" wire:model="floor_number" class="w-full border rounded px-3 py-2"></div>
        <div><label>Total Floors</label><input type="number" wire:model="total_floors" class="w-full border rounded px-3 py-2"></div>
        <div>
            <label>Furnishing Status</label>
            <select wire:model="furnishing_status" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Furnished">Furnished</option>
                <option value="Semi-Furnished">Semi-Furnished</option>
                <option value="Unfurnished">Unfurnished</option>
            </select>
        </div>
    @endif

    {{-- Office --}}
    @if ($property_type === 'Office')
        <div><label>Office Floor</label><input type="number" wire:model="office_floor" class="w-full border rounded px-3 py-2"></div>
        <div><label>Total Offices</label><input type="number" wire:model="total_offices" class="w-full border rounded px-3 py-2"></div>
        <div><label>Bathrooms</label><input type="number" wire:model="office_bathrooms" class="w-full border rounded px-3 py-2"></div>
        <div><label>Balconies</label><input type="number" wire:model="office_balconies" class="w-full border rounded px-3 py-2"></div>
        <div>
            <label>Office Area Unit</label>
            <select wire:model="office_area_size_unit" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Sq. Feet">Sq. Feet</option>
                <option value="Sq. Meters">Sq. Meters</option>
                <option value="Sq. Yards">Sq. Yards</option>
            </select>
        </div>
        <div><label>Office Area Size</label><input type="number" wire:model="office_area_size" class="w-full border rounded px-3 py-2" step="0.01"></div>
        <div>
            <label>Furnishing Status</label>
            <select wire:model="office_furnishing_status" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Furnished">Furnished</option>
                <option value="Semi-Furnished">Semi-Furnished</option>
                <option value="Unfurnished">Unfurnished</option>
            </select>
        </div>
    @endif

    {{-- Shop --}}
    @if ($property_type === 'Shop')
        <div>
            <label>Shop Type</label>
            <select wire:model="shop_type" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="In Market">In Market</option>
                <option value="In Mall">In Mall</option>
                <option value="Standalone">Standalone</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label>Shop Area Unit</label>
            <select wire:model="shop_area_size_unit" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Sq. Feet">Sq. Feet</option>
                <option value="Sq. Meters">Sq. Meters</option>
                <option value="Sq. Yards">Sq. Yards</option>
            </select>
        </div>
        <div><label>Front</label><input type="number" wire:model="shop_front" class="w-full border rounded px-3 py-2"></div>
        <div><label>Back</label><input type="number" wire:model="shop_back" class="w-full border rounded px-3 py-2"></div>
        <div><label>Side 1</label><input type="number" wire:model="shop_side_1" class="w-full border rounded px-3 py-2"></div>
        <div><label>Side 2</label><input type="number" wire:model="shop_side_2" class="w-full border rounded px-3 py-2"></div>
        <div><label>Shop Area (auto)</label><input type="text" wire:model="shop_area_size" class="w-full border rounded px-3 py-2 bg-gray-100" readonly></div>
        <div><label>Floor</label><input type="number" wire:model="shop_floor" class="w-full border rounded px-3 py-2"></div>
        <div class="flex items-center gap-2">
            <input type="checkbox" wire:model="shop_with_water_connection" id="water" class="w-5 h-5">
            <label for="water">Water Connection Available</label>
        </div>
    @endif

    {{-- Agriculture Land --}}
    @if ($property_type === 'Agriculture Land')
        <div>
            <label>Land Type</label>
            <select wire:model="land_type" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Farm House">Farm House</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label>Land Area Unit</label>
            <select wire:model="land_area_size_unit" class="w-full border rounded px-3 py-2">
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
        <div><label>Area Size</label><input type="number" wire:model="land_area_size" class="w-full border rounded px-3 py-2"></div>
        <div>
            <label>Current Status</label>
            <select wire:model="current_status_of_land" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="Cultivated">Cultivated</option>
                <option value="Vacant">Vacant</option>
                <option value="Under Dispute">Under Dispute</option>
                <option value="Other">Other</option>
            </select>
        </div>
    @endif
</div>
