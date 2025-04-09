<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- Price -->
    <div>
        <label class="block font-semibold mb-1">Price</label>
        <input type="number" step="0.01" wire:model="price" class="w-full border rounded px-3 py-2">
        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Negotiable Price -->
    <div class="flex items-center mt-2 gap-2">
        <input type="checkbox" wire:model="negotiable_price" id="negotiable_price" class="w-5 h-5">
        <label for="negotiable_price">Negotiable?</label>
    </div>

    <!-- Distances -->
    <div>
        <label>Nearest Hospital (Distance)</label>
        <input type="text" wire:model="hospital_distance" class="w-full border rounded px-3 py-2" placeholder="e.g. 2 km">
    </div>

    <div>
        <label>Nearest Railway Station (Distance)</label>
        <input type="text" wire:model="railway_distance" class="w-full border rounded px-3 py-2" placeholder="e.g. 5 km">
    </div>

    <div>
        <label>Public Transport (Distance)</label>
        <input type="text" wire:model="transport_distance" class="w-full border rounded px-3 py-2" placeholder="e.g. 500 m">
    </div>

    <!-- Image Upload -->
    <div>
        <label>Thumbnail Image</label>
        <input type="file" wire:model="image" class="w-full border rounded px-3 py-2">
        @if ($image)
            <div class="mt-2">
                <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover border">
            </div>
        @endif
        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Area -->
    <div>
        <label>Total Area (Label Based)</label>
        <input type="text" wire:model="area" class="w-full border rounded px-3 py-2" placeholder="e.g. 1200 Sq. Ft.">
    </div>

    <!-- Facing -->
    <div>
        <label>Facing</label>
        <select wire:model="facing" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            <option value="North">North</option>
            <option value="South">South</option>
            <option value="East">East</option>
            <option value="West">West</option>
        </select>
    </div>

    <!-- Location -->
    <div>
        <label>Location (Locality)</label>
        <input type="text" wire:model="location" class="w-full border rounded px-3 py-2">
        @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- City -->
    <div>
        <label>City</label>
        <select wire:model="city_id" class="w-full border rounded px-3 py-2">
            <option value="">Select City</option>
            @foreach(App\Models\City::all() as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        @error('city_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Description -->
    <div class="md:col-span-2">
        <label>Description</label>
        <textarea wire:model="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
    </div>

</div>
