@push('scripts')
<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

          <div class="modal-header">
            <h5 class="modal-title">🔐 Login to Continue</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

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
            
            
          </div>

          <div class="modal-footer">
            <button class="btn btn-primary w-100" type="submit">Login</button>
        
            <div class="mt-2 text-center">
                <small>
                    New user?
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
                        Create an account
                    </a>
                </small>
            </div>
        </div>
        </form>
      </div>
    </div>
</div>
