<div class="auth-box">
    @if($authenticated || auth()->check())
        @if(auth()->id() !== $propertyUserId)
            <a href="tel:{{ $propertyUserMobile }}" class="btn btn-success w-100">📞 Call Now</a>
        @else
            <div class="text-muted">This is your listing</div>
        @endif
    @else
        <div class="card p-3">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a href="#" wire:click.prevent="switchTab('login')" class="nav-link {{ $tab === 'login' ? 'active' : '' }}">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#" wire:click.prevent="switchTab('register')" class="nav-link {{ $tab === 'register' ? 'active' : '' }}">Register</a>
                </li>
            </ul>

            @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

            @if($tab === 'login')
                <form wire:submit.prevent="login">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" wire:model.defer="email" class="form-control">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" wire:model.defer="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            @endif

            @if($tab === 'register')
                <form wire:submit.prevent="register">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Mobile Number</label>
                        <input type="text" wire:model.defer="mobile_number" class="form-control">
                        @error('mobile_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>City</label>
                        <select wire:model="city_id" class="form-select">
                            <option value="">-- Select City --</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" wire:model.defer="email" class="form-control">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" wire:model.defer="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" wire:model.defer="password_confirmation" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Referral ID (Optional)</label>
                        <input type="text" wire:model.defer="ref_id" class="form-control">
                        @error('ref_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
            @endif
        </div>
    @endif
</div>
