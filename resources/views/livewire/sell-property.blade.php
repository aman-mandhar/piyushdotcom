


<div class="container py-4">
    <div class="card shadow border-0 rounded">

        {{-- Progress Bar --}}
        <div class="card-header p-0">
            <div class="bg-light p-3 rounded-top">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="fw-semibold text-success">Step {{ $step }} of 4</small>
                    <small class="fw-semibold text-muted">{{ $this->percent }}%</small>
                </div>

                <div class="progress" style="height: 10px;">
                    <div 
                        class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        style="width: {{ $this->percent }}%; transition: width 0.4s ease;"
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

                {{-- Listing Type --}}
                <h6 class="mb-4 fw-bold text-primary">What is you goal?</h6>
                <div class="row g-3 mb-4">
                    @foreach($listingTypes as $type)
                        <label class="custom-radio w-100">
                            <input type="radio" wire:model="listing_type_id" value="{{ $type->id }}">
                            <span class="radio-label">{{ $type->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('listing_type_id') <span class="text-danger small">{{ $message }}</span> @enderror

                {{-- Property Type --}}
                <h6 class="mb-4 fw-bold text-primary">Select type of your Property?</h6>
                <div class="row g-3 mb-4">
                    @foreach($propertyTypes as $type)
                        <div class="col-md-4">
                            <label class="custom-radio w-100">
                                <input type="radio" wire:model="property_type_id" value="{{ $type->id }}">
                                <span class="radio-label">{{ $type->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('property_type_id') <span class="text-danger small">{{ $message }}</span> @enderror

                <button wire:click="nextStep" class="btn btn-primary mt-3">Next</button>
            @endif


            {{-- Step 2 --}}
            @if($step === 2)
                <h5 class="mb-3">Step 2: Enter {{ $propertyTypes->find($property_type_id)->name ?? '' }} Details</h5>

                @switch($property_type_id)
                    @case(1)
                        @include('livewire.property-steps.plot')
                        @break
                    @case(2)
                        @include('livewire.property-steps.house')
                        @break
                    @case(3)
                        @include('livewire.property-steps.apartment')
                        @break
                    @case(4)
                        @include('livewire.property-steps.villa')
                        @break
                    @case(5)
                        @include('livewire.property-steps.office')
                        @break
                    @case(6)
                        @include('livewire.property-steps.shop')
                        @break
                    @case(7)
                        @include('livewire.property-steps.agriculture')
                        @break
                    @case(8)
                        @include('livewire.property-steps.industrial')
                        @break
                @endswitch

                <button wire:click="nextStep" class="btn btn-success mt-4">Next</button>
            @endif

            {{-- Step 3 --}}
            @if($step === 3)
                <h5 class="mb-3">Step 3: Enter Main Property Details</h5>
                @include('livewire.property-steps.main')

                <button wire:click="nextStep" class="btn btn-success mt-4">Save & Next</button>
            @endif

            {{-- Step 4 --}}
            @if($step === 4)
                <h5 class="mb-3">Step 4: Additional Optional Info</h5>
                @include('livewire.property-steps.optional')

                <button wire:click="updateProperty" class="btn btn-primary mt-4">Update</button>
            @endif

        </div>
    </div>
</div>
