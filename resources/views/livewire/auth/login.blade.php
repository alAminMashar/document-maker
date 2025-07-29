<div class="row flex-grow">
    <div class="col-md-6 mx-auto">
        <div class="auth-form-light text-left p-5">

            <div class="brand-logo">
                <img src="{{ asset('../../assets/images/logo/logo.png') }}">
            </div>

            <h4 class="text-primary">
                {{ config('app.name') }}
            </h4>

            <h6 class="font-weight-light">
                Sign in to continue.
            </h6>

            @include('livewire.auth.partials.login-form')
        </div>
    </div>
</div>
