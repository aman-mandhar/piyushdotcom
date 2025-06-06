<section class="property-box mb-5">
    <h5 class="fw-bold text-success mb-4">ℹ️ Additional Property Info</h5>

    <div class="row g-3">
        

        <!-- Nearby Distances -->
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">How far is the nearest hospital?</h6>
            <input type="text" wire:model.defer="hospital_distance" class="form-control" placeholder="e.g. 2 km">
        </div>
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">Distance to Railway Station</h6>
            <input type="text" wire:model.defer="railway_distance" class="form-control" placeholder="e.g. 4.5 km">
        </div>
        <div class="col-md-4">
            <h6 class="fw-semibold text-primary">Distance to Bus Stand</h6>
            <input type="text" wire:model.defer="transport_distance" class="form-control" placeholder="e.g. 1.8 km">
        </div>

        

        <!-- Court Case -->
        <div class="col-md-12">
            <h6 class="fw-semibold text-primary">Is there a court case involved?</h6>
            <div class="d-flex gap-3">
                @foreach(['No', 'Yes'] as $val)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="court_case" value="{{ $val }}">
                        <span>{{ $val }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        @if($court_case === 'Yes')
            <div class="col-md-12">
                <h6 class="fw-semibold text-primary">Provide Case Details</h6>
                <textarea wire:model.defer="court_case_details" rows="2" class="form-control" placeholder="Details about the dispute, court name, etc."></textarea>
                @error('court_case_details') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        @endif
    </div>
</section>
