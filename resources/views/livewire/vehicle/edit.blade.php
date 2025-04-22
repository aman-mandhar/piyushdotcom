<div class="container py-4">
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <h4>Edit Vehicle Listing</h4>
        <hr>

        <!-- Owner Info -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Owner Name</label>
                <input type="text" class="form-control" wire:model="owner_name">
                @error('owner_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6">
                <label>Mobile</label>
                <input type="text" class="form-control" wire:model="owner_mobile">
                @error('owner_mobile') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Email & Address -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" class="form-control" wire:model="owner_email">
            </div>
            <div class="col-md-6">
                <label>Address</label>
                <input type="text" class="form-control" wire:model="owner_address">
            </div>
        </div>

        <!-- City -->
        <div class="mb-3">
            <label>City</label>
            <select class="form-control" wire:model="city_id">
                <option value="">-- Select City --</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Vehicle Info -->
        <h5 class="mt-4">Vehicle Details</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Brand</label>
                <input type="text" class="form-control" wire:model="brand">
                @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6">
                <label>Model</label>
                <input type="text" class="form-control" wire:model="model">
                @error('model') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Variant</label>
                <input type="text" class="form-control" wire:model="variant">
            </div>
            <div class="col-md-6">
                <label>Registration Number</label>
                <input type="text" class="form-control" wire:model="registration_number">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label>Registration Year</label>
                <input type="text" class="form-control" wire:model="registration_year">
            </div>
            <div class="col-md-3">
                <label>KM Driven</label>
                <input type="text" class="form-control" wire:model="km_driven">
            </div>
            <div class="col-md-3">
                <label>Fuel Type</label>
                <input type="text" class="form-control" wire:model="fuel_type">
            </div>
            <div class="col-md-3">
                <label>Transmission</label>
                <select class="form-control" wire:model="transmission">
                    <option value="">-- Select --</option>
                    <option value="Manual">Manual</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>No. of Owners</label>
                <input type="number" class="form-control" wire:model="no_of_owners">
            </div>
            <div class="col-md-6">
                <label>Insurance Status</label>
                <input type="text" class="form-control" wire:model="insurance_status">
            </div>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" wire:model="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Price (₹)</label>
            <input type="text" class="form-control" wire:model="price">
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Accident Info -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" wire:model="any_accident" id="accidentCheckbox">
            <label class="form-check-label" for="accidentCheckbox">Has the vehicle met with any accident?</label>
        </div>

        @if($any_accident)
            <div class="mb-3">
                <label>Accident Details</label>
                <textarea class="form-control" rows="2" wire:model="accident_detail"></textarea>
                @error('accident_detail') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @endif

        <!-- Loan Info -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" wire:model="loan_running" id="loanCheckbox">
            <label class="form-check-label" for="loanCheckbox">Loan Running?</label>
        </div>

        @if($loan_running)
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" wire:model="loan_bank_name">
                    @error('loan_bank_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <label>Pending EMIs</label>
                    <input type="number" class="form-control" wire:model="pending_emis">
                </div>
                <div class="col-md-3">
                    <label>EMI Amount</label>
                    <input type="text" class="form-control" wire:model="emi_amount">
                </div>
            </div>
        @endif

        <!-- Existing Image -->
        @if ($featured_image && !$new_image)
            <div class="mb-3">
                <label>Current Image:</label><br>
                <img src="{{ asset('storage/' . $featured_image) }}" style="max-height: 200px;" class="img-thumbnail">
            </div>
        @endif

        <!-- New Image Upload -->
        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" class="form-control" wire:model="new_image">
            @if ($new_image)
                <div class="mt-2">
                    <p>Preview:</p>
                    <img src="{{ $new_image->temporaryUrl() }}" style="max-height: 200px;" class="img-thumbnail">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Vehicle</button>
    </form>
</div>

