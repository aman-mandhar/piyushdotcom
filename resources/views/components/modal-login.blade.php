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
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
          </div>
  
          <div class="modal-footer">
            <button class="btn btn-primary w-100" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>