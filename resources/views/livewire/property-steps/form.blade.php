<div class="container col-md-12">
    <div class="row">
        <div class="col-md-3">
            @include('components.responsive-step-nav')
        </div>
        <div class="col-md-9">
            <!-- Step Loader -->
            <form wire:submit.prevent="{{ $step === 5 ? 'createProperty' : 'nextStep' }}">
                @includeIf('livewire.property.steps.step' . $step)

                <div class="mt-6 flex justify-between">
                    @if ($step > 1)
                        <button type="button" wire:click="previousStep">Back</button>
                    @endif

                    <button type="submit">{{ $step === 5 ? 'Submit' : 'Next' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>