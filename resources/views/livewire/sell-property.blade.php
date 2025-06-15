<style>
    .progress-bar {
        transition: width 0.4s ease-in-out;
    }

    h5, h6 {
        margin-bottom: 0.75rem;
    }

    .btn-check:checked + .btn-outline-primary {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .btn-check:checked + .btn-outline-success {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }

    .radio-btn-group label {
        cursor: pointer;
    }
</style>

<div class="container py-4">
    <div class="card shadow border-0 rounded">

        {{-- Progress Header --}}
        <div class="card-header p-0">
            <div class="bg-light p-3 rounded-top">

                {{-- Optional Stepper Header --}}
                <div class="d-flex justify-content-between small text-uppercase mb-2 fw-semibold">
                    <span class="{{ $step >= 1 ? 'text-success' : 'text-muted' }}">1. Listing</span>
                    <span class="{{ $step >= 2 ? 'text-success' : 'text-muted' }}">2. Type Details</span>
                    <span class="{{ $step >= 3 ? 'text-success' : 'text-muted' }}">3. Main</span>
                    <span class="{{ $step >= 4 ? 'text-success' : 'text-muted' }}">4. Optional</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="fw-semibold text-success">Step {{ $step }} of 4</small>
                    <small class="fw-semibold text-muted">{{ $this->percent }}%</small>
                </div>

                <div class="progress" style="height: 10px;">
                    <div 
                        class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        style="width: {{ $this->percent }}%;"
                        aria-valuenow="{{ $this->percent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Body --}}
        <div class="card-body">
            {{-- Step 1 --}}
            @if($step === 1)
                <h5 class="mb-4 fw-bold text-primary">Step 1: Choose Listing Type & Property Type</h5>

                <h6 class="fw-semibold text-primary mb-2">What is your goal?</h6>
                @foreach($listingTypes as $type)
                    <div class="form-check form-check-inline">
                        <input type="radio" wire:model="listing_type_id" value="{{ $type->id }}" id="listing_{{ $type->id }}" class="form-check-input" name="listing_type_id">
                        <label class="form-check-label" for="listing_{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                @endforeach
                @error('listing_type_id') <div class="text-danger small">{{ $message }}</div> @enderror

                <h6 class="fw-semibold text-primary mt-4 mb-2">Select type of your Property</h6>
                @foreach($propertyTypes as $type)
                    <div class="form-check form-check-inline">
                        <input type="radio" wire:model="property_type_id" value="{{ $type->id }}" id="property_{{ $type->id }}" class="form-check-input" name="property_type_id">
                        <label class="form-check-label" for="property_{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                @endforeach
                @error('property_type_id') <div class="text-danger small">{{ $message }}</div> @enderror

                <button wire:click="nextStep" class="btn btn-success mt-4">Next</button>
            @endif


            {{-- Step 2 --}}
            @if($step === 2)
                @php
                    $selectedType = $propertyTypes->firstWhere('id', $property_type_id);
                @endphp
                <h5 class="mb-3">Step 2: Enter {{ $selectedType->name ?? '' }} Details</h5>

                @switch($property_type_id)
                    @case(1) @include('livewire.property-steps.plot') @break
                    @case(2) @include('livewire.property-steps.house') @break
                    @case(3) @include('livewire.property-steps.apartment') @break
                    @case(4) @include('livewire.property-steps.villa') @break
                    @case(5) @include('livewire.property-steps.office') @break
                    @case(6) @include('livewire.property-steps.shop') @break
                    @case(7) @include('livewire.property-steps.agriculture') @break
                    @case(8) @include('livewire.property-steps.industrial') @break
                @endswitch

                <button wire:click="nextStep"
                        class="btn btn-success mt-4"
                        wire:loading.attr="disabled"
                        wire:target="nextStep">
                    <span wire:loading.remove wire:target="nextStep">Next</span>
                    <span wire:loading wire:target="nextStep">
                        <i class="spinner-border spinner-border-sm"></i> Saving...
                    </span>
                </button>
            @endif

            {{-- Step 3 --}}
            @if($step === 3)
                <h5 class="mb-3">Step 3: Enter Main Property Details</h5>
                @include('livewire.property-steps.main')

                <button wire:click="nextStep"
                        class="btn btn-success mt-4"
                        wire:loading.attr="disabled"
                        wire:target="nextStep">
                    <span wire:loading.remove wire:target="nextStep">Save & Next</span>
                    <span wire:loading wire:target="nextStep">
                        <i class="spinner-border spinner-border-sm"></i> Saving...
                    </span>
                </button>
            @endif

            {{-- Step 4 --}}
            @if($step === 4)
                <h5 class="mb-3">Step 4: Additional Optional Info</h5>
                @include('livewire.property-steps.optional')

                <button wire:click="updateProperty"
                        class="btn btn-primary mt-4"
                        wire:loading.attr="disabled"
                        wire:target="updateProperty">
                    <span wire:loading.remove wire:target="updateProperty">Update</span>
                    <span wire:loading wire:target="updateProperty">
                        <i class="spinner-border spinner-border-sm"></i> Updating...
                    </span>
                </button>
            @endif

        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', () => {
        console.log('Livewire loaded ✔️');

        Livewire.hook('component.initialized', (component) => {
            console.log('Component Initialized:', component.name);
        });

        Livewire.hook('element.updated', (el, component) => {
            console.log('Updated Element:', el);
        });
    });
</script>