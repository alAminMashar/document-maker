<form class="pt-3 {{ auth() ? '' : 'd-none' }}">

    <div class="form-group">
        <input type="email" wire:model.defer="email" class="form-control form-control-lg" placeholder="Email Address"
            @error('email') is-invalid @enderror">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" wire:model.defer="password" class="form-control form-control-lg" placeholder="Password"
            @error('password') is-invalid @enderror">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mt-3">
        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
            wire:click.prevent="login()" wire:loading.attr="disabled">
            <span wire:loading.remove>
                Sign In
            </span>
            <span wire:loading.block>
                <i class="mdi mdi-loading mdi-spin"></i>
                Loading, please wait...
            </span>
        </button>
    </div>

    <div class="my-2 d-flex justify-content-between align-items-center d-none">
        <div class="form-check">
            {{-- <label class="form-check-label text-muted"> --}}
            {{-- <input type="checkbox" class="form-check-input"> --}}
            {{-- Keep me signed in --}}
            {{-- </label> --}}
        </div>
        {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
        <div class="col">
            <blockquote class="blockquote text-center">
                <small class="mb-0 fs-6 text-muted" id="quote">
                    <i>"{{ $quote }}"</i>
                </small>
                <footer class="blockquote-footer mt-2 text-muted">
                    {{ $author }}
                </footer>
            </blockquote>
        </div>


    </div>

</form>
