<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {{-- Livewire Register Component --}}
            @livewire('register')

            {{-- Login Link in Footer --}}
            <div class="modal-footer text-center d-block">
                <small>
                    Already have an account?
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                        Login
                    </a>
                </small>
            </div>

        </div>
    </div>
</div>