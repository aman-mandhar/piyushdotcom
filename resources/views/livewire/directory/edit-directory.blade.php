<div class="container mt-4">
    <h2 class="mb-4">Edit Business Directory</h2>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="update">
        <div class="mb-3">
            <label class="form-label">Business Name</label>
            <input type="text" wire:model.defer="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" wire:model.defer="address" class="form-control">
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">City</label>
            <select wire:model.defer="city_id" class="form-select">
                <option value="">Select City</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile</label>
            <input type="text" wire:model.defer="mobile" class="form-control">
            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" wire:model.defer="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Multi-checkbox for Business Type -->
        <div class="mb-3">
            <label class="form-label">Business Type <small class="text-muted">(Select one or more)</small></label>
            <div class="row">
                @php
                    $types = [
                        'Architect',
                        'Engineer',
                        'Electric Contractor',
                        'Sanitation Contractor',
                        'Wooden Contractor',
                        'Interior Decorator',
                        'Building Material Supplier',
                        'Labor Contractor',
                        'Other',
                    ];
                @endphp

                @foreach ($types as $type)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="business_type"
                                   value="{{ $type }}"
                                   id="type_{{ Str::slug($type) }}">
                            <label class="form-check-label" for="type_{{ Str::slug($type) }}">
                                {{ $type }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('business_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Video Link (optional)</label>
            <input type="url" wire:model.defer="video_link" class="form-control">
            @error('video_link') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Directory</button>
    </form>
</div>

