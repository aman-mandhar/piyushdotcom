<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- Thumbnail Image Upload -->
    <div>
        <label class="block font-semibold mb-1">Thumbnail Image</label>
        <input type="file" wire:model="image" class="w-full border rounded px-3 py-2">
        @if ($image)
            <div class="mt-2">
                <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover border rounded">
            </div>
        @endif
        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Optional extra space for media tips -->
    <div>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-3 rounded">
            <strong>Tip:</strong> Upload clear images to attract more buyers!
        </div>
    </div>

    <!-- Description -->
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 mt-4">Property Description</label>
        <textarea wire:model="description" rows="5" class="w-full border rounded px-3 py-2"
                  placeholder="Describe your property..."></textarea>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

</div>
