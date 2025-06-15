
<style>
    .plot-box {
        border: 2px solid #198754 !important;  /* Solid green border */
        border-radius: 20px !important;
        padding: 1.5rem;
        background-color: #ffffff;
        box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }


    .custom-radio-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        cursor: pointer;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .custom-radio-btn input[type="radio"] {
        display: none;
    }

    .custom-radio-btn input[type="radio"]:checked + span {
        background-color: #0d6efd;
        color: white;
        border-radius: 5px;
        padding: 0.4rem 1rem;
    }
</style>


<div class="row g-4"
     x-data="{
        front: @entangle('plot.plot_front').defer,
        back: @entangle('plot.plot_back').defer,
        side1: @entangle('plot.plot_side_1').defer,
        side2: @entangle('plot.plot_side_2').defer,

        get area() {
            let f = parseFloat(this.front || 0);
            let b = parseFloat(this.back || 0);
            let s1 = parseFloat(this.side1 || 0);
            let s2 = parseFloat(this.side2 || 0);
            if (!f || !b || !s1 || !s2) return '';
            let avgWidth = (f + b) / 2;
            let avgDepth = (s1 + s2) / 2;
            return (avgWidth * avgDepth).toFixed(2);
        }
    }"
     x-effect="$wire.set('plot.plot_size', parseFloat(area))">

    <!-- Left Column: Plot Calculator -->
    <div class="col-md-4">
        <div class="plot-box">
            <h5 class="fw-bold text-success mb-3">📏 Calculate Plot Area</h5>

            <div class="mb-3">
                <label class="form-label">Front (ft)</label>
                <input type="number" step="0.01" x-model="front" class="form-control">
                @error('plot.plot_front') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Back (ft)</label>
                <input type="number" step="0.01" x-model="back" class="form-control">
                @error('plot.plot_back') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Left (ft)</label>
                <input type="number" step="0.01" x-model="side1" class="form-control">
                @error('plot.plot_side_1') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Right (ft)</label>
                <input type="number" step="0.01" x-model="side2" class="form-control">
                @error('plot.plot_side_2') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label fw-semibold">Total Area (sq. ft.)</label>
                <input type="text" :value="area" class="form-control bg-light" readonly>
                @error('plot.plot_size') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Middle Column: Other Fields -->
    <div class="col-md-4">
        <h5 class="fw-bold text-primary mb-3">🏷️ Plot Classification</h5>

        <div class="mb-3">
            <label class="form-label">Use As</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Residential', 'Commercial', 'Industrial', 'Mix'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="plot.use_as" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('plot.use_as') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Advantage</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" wire:model.defer="plot.advantage" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('plot.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>

    
    <!-- Right Column: Upload Image -->
    <div class="col-md-4">
        <h5 class="fw-bold text-primary mb-3">🖼️ Upload Property Image</h5>

        <input type="file" wire:model="image" class="form-control">
        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

        <div wire:loading wire:target="image" class="text-muted small mt-2">Uploading...</div>

        @if ($image)
            <div class="mt-3 border rounded p-2">
                <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 280px;">
            </div>
        @endif
    </div>
</div>
