<div>
    <div class="card">
        <div class="card-header text-center">
            {{ __('FREE Signup') }}
        </div>

        <div class="card-body">
            <form class="form" wire:submit.prevent="register">

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" wire:model.lazy="name" id="name" name="name" class="form-control" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Mobile Number --}}
                <div class="mb-3">
                    <label for="mobile_number" class="form-label">{{ __('Mobile Number') }}</label>
                    <input type="text" wire:model.lazy="mobile_number" id="mobile_number" name="mobile_number" class="form-control" required>
                    @error('mobile_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" wire:model.lazy="email" id="email" name="email" class="form-control" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="input-group">
                        <input type="password" wire:model.lazy="password" id="password" name="password" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                            <i class="fa fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group">
                        <input type="password" wire:model.lazy="password_confirmation" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                            <i class="fa fa-eye" id="password_confirmation-icon"></i>
                        </button>
                    </div>
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- City --}}
                <div class="mb-3">
                    <label for="city_id" class="form-label">{{ __('City') }}</label>
                    <select wire:model.lazy="city_id" id="city_id" name="city_id" class="form-control" required>
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Terms --}}
                <div class="form-check mb-3">
                    <input type="checkbox" wire:model.lazy="terms" id="terms" name="terms" class="form-check-input" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#">Terms & Conditions</a>
                    </label>
                    @error('terms') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Submit --}}
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success">
                        {{ __('Register') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Already have account --}}
    <div class="text-center mt-2">
        <small>
            Already have an account?
            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a>
        </small>
    </div>
</div>