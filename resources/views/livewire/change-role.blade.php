@if (session()->has('errors_list'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session('errors_list') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">
                    {{ __('FREE Signup') }}
                </div>
                <div class="card-body">
                    <form class="form" wire:submit.prevent="register">
                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Name') }}</label>
                            <div class="col-md-9">
                                <input type="text" wire:model.lazy="name" id="name" name="name" class="form-control" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div class="form-group row">
                            <label for="mobile_number" class="col-md-3 col-form-label">{{ __('Mobile Number') }}</label>
                            <div class="col-md-9">
                                <input type="text" wire:model.lazy="mobile_number" id="mobile_number" name="mobile_number" class="form-control" required>
                                @error('mobile_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Email (Always Present) -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label">{{ __('Email') }}</label>
                            <div class="col-md-9">
                                <input type="email" wire:model.lazy="email" id="email" name="email" class="form-control" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row" x-data="{ show: false }">
                            <label for="password" class="col-md-3 col-form-label">{{ __('Password') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input :type="show ? 'text' : 'password'" wire:model.lazy="password" id="password" class="form-control" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                            <i :class="show ? 'fa fa-eye-slash' : 'fa fa-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group row" x-data="{ show: false }">
                            <label for="password_confirmation" class="col-md-3 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input :type="show ? 'text' : 'password'" wire:model.lazy="password_confirmation" id="password_confirmation" class="form-control" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                            <i :class="show ? 'fa fa-eye-slash' : 'fa fa-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <!-- City Selection -->
                        <div class="form-group row">
                            <label for="city_id" class="col-md-3 col-form-label">{{ __('City') }}</label>
                            <div class="col-md-9">
                                <select wire:model.lazy="city_id" id="city_id" name="city_id" class="form-control" required>
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Referral Code(optional) -->
                        <div class="form-group row">
                            <label for="ref_id" class="col-md-3 col-form-label">{{ __('Referral (Optional)') }}</label>
                            <div class="col-md-9">
                                <select wire:model.lazy="ref_id" id="ref_id" class="form-control">
                                    <option value="">Select Referral (Optional)</option>
                                    @foreach($users as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->name }}</option>
                                    @endforeach
                                </select>
                                @error('ref_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!--Select User Role-->
                        <div class="form-group">
                            <label for="role_id">Select Role</label>
                            <select wire:model="role_id" class="form-control" id="role_id">
                                <option value="user">Select user role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Referral Name(optional) -->
                        @if($ref_id)
                            <div class="form-group row">
                                <span class="col-md-3">{{ $ref_name }}</span>
                            </div>
                        @endif

                        <!-- Terms & Conditions -->
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <div class="form-check">
                                    <input type="checkbox" wire:model.lazy="terms" id="terms" name="terms" class="form-check-input" required>
                                    <label for="terms" class="form-check-label">I agree to the <a href="#">Terms & Conditions</a></label>
                                    @error('terms') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


