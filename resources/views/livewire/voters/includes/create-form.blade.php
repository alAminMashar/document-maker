<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addVoter)
                <h4 class="card-title">Add Voter</h4>
            @endif
            @if ($updateVoter)
                <h4 class="card-title">Update Voter Details</h4>
            @endif
            <form class="forms-sample">

                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">
                            Name
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter name" wire:model.defer="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="phone_number">
                            Phone
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                            id="phone_number" placeholder="Enter phone number" wire:model.defer="phone_number">
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="email">
                            Email
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Enter email" wire:model.defer="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="ip_address">
                            IP Address
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('ip_address') is-invalid @enderror"
                            id="ip_address" placeholder="Enter ip address" wire:model.defer="ip_address">
                        @error('ip_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="browser">
                            Browser
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('browser') is-invalid @enderror" id="browser"
                            placeholder="Enter browser" wire:model.defer="browser">
                        @error('browser')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="city">
                            City
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                            placeholder="Enter city" wire:model.defer="city">
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="country">
                            Country
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                            placeholder="Enter country" wire:model.defer="country">
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="device">
                            Device
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('device') is-invalid @enderror" id="device"
                            placeholder="Enter device" wire:model.defer="device">
                        @error('device')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="platform">
                            Platform
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('platform') is-invalid @enderror"
                            id="platform" placeholder="Enter platform" wire:model.defer="platform">
                        @error('platform')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="user_agent">
                            User Agent
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('user_agent') is-invalid @enderror"
                            id="user_agent" placeholder="Enter user_agent" wire:model.defer="user_agent">
                        @error('user_agent')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="referer">
                            Referer
                            <span class="text-muted">Optional</span>
                        </label>
                        <input type="text" class="form-control @error('referer') is-invalid @enderror"
                            id="referer" placeholder="Enter referer" wire:model.defer="referer">
                        @error('referer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" wire:loading.remove>
                        @if ($addVoter)
                            <button wire:click.prevent="storePoll()" class="btn btn-gradient-primary me-2 col">
                                Submit
                            </button>
                        @endif
                        @if ($updateVoter)
                            <button wire:click.prevent="updateVoter()" class="btn btn-gradient-primary me-2 col">
                                Save Changes
                            </button>
                        @endif
                        <button wire:click.prevent="cancelPoll()" class="btn btn-danger col">
                            Cancel
                        </button>
                    </div>
                    <div class="col-12" wire:loading.block>
                        <span class="text-warning">
                            <i class="mdi mdi-loading mdi-spin"></i>
                            Loading, please wait...
                        </span>
                    </div>
                </div>

                {{--
                    <div class="col-12" wire:loading.block wire:loading.remove>
                        <span class="text-warning">
                            <i class="mdi mdi-loading mdi-spin"></i>
                            Loading, please wait...
                        </span>
                    </div>
                --}}

            </form>
        </div>
    </div>
</div>
