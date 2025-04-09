<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- City -->
    <div>
        <label class="block font-semibold mb-1">City</label>
        <select wire:model="city_id" class="w-full border rounded px-3 py-2">
            <option value="">Select City</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        @error('city_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Location -->
    <div>
        <label class="block font-semibold mb-1">Location (Locality)</label>
        <input type="text" wire:model="location" class="w-full border rounded px-3 py-2">
        @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Price -->
    <div>
        <label class="block font-semibold mb-1">Price</label>
        <input type="number" step="0.01" wire:model="price" class="w-full border rounded px-3 py-2">
        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Negotiable -->
    <div class="flex items-center mt-2 gap-2">
        <input type="checkbox" wire:model="negotiable_price" id="negotiable_price" class="w-5 h-5">
        <label for="negotiable_price">Negotiable?</label>
    </div>

    <!-- Facing -->
    <div>
        <label class="block font-semibold mb-1">Facing</label>
        <select wire:model="facing" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            @foreach ($directions as $direction)
                <option value="{{ $direction }}">{{ $direction }}</option>
            @endforeach
        </select>
    </div>

    <!-- Total Area (Optional Label Field) -->
    <div>
        <label class="block font-semibold mb-1">Total Area (Label Based)</label>
        <input type="text" wire:model="area" class="w-full border rounded px-3 py-2" placeholder="e.g. 1200 Sq. Ft.">
    </div>

    <!-- Distance to Hospital -->
    <div>
        <label class="block font-semibold mb-1">Nearest Hospital (Distance)</label>
        <input type="text" wire:model="hospital_distance" class="w-full border rounded px-3 py-2" placeholder="e.g. 2 km">
    </div>

    <!-- Distance to Railway Station -->
    <div>
        <label class="block font-semibold mb-1">Nearest Railway Station (Distance)</label>
        <input type="text" wire:model="railway_distance" class="w-full border rounded px-3 py-2" placeholder="e.g. 5 km">
    </div>

    <!-- Distance to Public Transport -->
    <div>
        <label class="block font-semibold mb-1">Public Transport (Distance)</label>
        <input type="text" wire:model="transport_distance" class="w-full border rounded px-3 py-2" placeholder="e.g. 500 m">
    </div>

</div>
