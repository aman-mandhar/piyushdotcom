<style>
    .plot-box {
        border: 2px solid #198754 !important;
        border-radius: 20px !important;
        padding: 1.5rem;
        background-color: #ffffff;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
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

    <!-- 🧮 Plot Area Calculator -->
    <div class="col-md-4">
        <div class="plot-box">
            <div class="bg-light border-start border-4 border-success p-2 ps-3 mb-3 rounded">
                <h6 class="fw-semibold text-success">📏 Calculate Plot Area</h6>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="fw-semibold text-primary">Front (ft)</h6>
                    <input type="number" step="0.01" x-model="front" @input="$wire.set('plot.plot_front', front)" class="form-control">
                    @error('plot.plot_front') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <h6 class="fw-semibold text-primary">Back (ft)</h6>
                    <input type="number" step="0.01" x-model="back" @input="$wire.set('plot.plot_back', back)" class="form-control">
                    @error('plot.plot_back') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <h6 class="fw-semibold text-primary">Left (ft)</h6>
                    <input type="number" step="0.01" x-model="side1" @input="$wire.set('plot.plot_side_1', side1)" class="form-control">
                    @error('plot.plot_side_1') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <h6 class="fw-semibold text-primary">Right (ft)</h6>
                    <input type="number" step="0.01" x-model="side2" @input="$wire.set('plot.plot_side_2', side2)" class="form-control">
                    @error('plot.plot_side_2') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12" x-show="area">
                    <h6 class="fw-semibold text-primary">Total Area: <span x-text="area"></span> sq. ft.</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- 🏷️ Plot Classification -->
    <div class="col-md-4">
        <div class="bg-light border-start border-4 border-primary p-2 ps-3 mb-3 rounded">
            <h6 class="fw-semibold text-primary">🏷️ Plot Classification</h6>
        </div>

        <div class="mb-3">
            <h6 class="fw-semibold text-primary">Use As</h6>
            <div class="d-grid gap-2" style="grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); display: grid;">
                @foreach(['Residential', 'Commercial', 'Industrial', 'Mix'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" name="use_as" wire:model="plot.use_as" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('plot.use_as') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>


        <div class="mb-3">
            <h6 class="fw-semibold text-primary">Advantage</h6>
            <div class="d-grid gap-2" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); display: grid;">
                @foreach(['Corner', 'On Road', 'Park Facing', 'Normal'] as $option)
                    <label class="custom-radio-btn">
                        <input type="radio" name="advantage" wire:model="plot.advantage" value="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('plot.advantage') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- 📍 Plot Facing & Media -->
    <div class="col-md-4">
        <div class="bg-light border-start border-4 border-secondary p-2 ps-3 mb-3 rounded">
            <h6 class="fw-semibold text-secondary">📍 Plot Facing & Media</h6>
        </div>

        <div class="mb-3">
            <h6 class="fw-semibold text-primary">Plot Facing</h6>
            <div class="d-grid gap-2" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); display: grid;">
                @foreach(['North','North-East','North-West','South','South-East','South-West','East','West'] as $face)
                    <label class="custom-radio-btn">
                        <input type="radio" name="plot_facing" wire:model="plot.plot_facing" value="{{ $face }}">
                        <span>{{ $face }}</span>
                    </label>
                @endforeach
            </div>
            @error('plot.plot_facing') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <h6 class="fw-semibold text-primary">YouTube Video Link (Optional)</h6>
            <input type="url" wire:model.defer="plot.video_link" class="form-control" placeholder="e.g. https://youtu.be/xyz123">
            @error('plot.video_link') <span class="text-danger small">{{ $message }}</span> @enderror

            @if(Str::contains($plot['video_link'] ?? '', 'youtu'))
                <div class="mt-3">
                    <iframe width="100%" height="280" src="{{ Str::replace('youtu.be/', 'www.youtube.com/embed/', $plot['video_link']) }}" frameborder="0" allowfullscreen></iframe>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <h6 class="fw-semibold text-primary">Upload Property Image</h6>
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
</div>
