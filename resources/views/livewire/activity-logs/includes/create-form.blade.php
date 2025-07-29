<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addBonus)
                <h4 class="card-title">Add Bonus</h4>
            @endif
            @if ($updateBonus)
                <h4 class="card-title">Update Bonus Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">

                    <div class="form-group col-6">
                        <label for="name">
                            Bonus Name
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter name" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="positions">
                            Employee Position
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <select wire:model="employee_position_id"
                            class="form-control form-control-sm @error('employee_position_id') is-invalid @enderror"
                            id="positions">
                            <option>Select Option</option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}">
                                    {{ $pos->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('employee_position_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="amount">
                            Bonus Amount
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                            placeholder="Enter amount" wire:model="amount">
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @if ($addBonus)
                                <button wire:click.prevent="storeBonus()" class="btn btn-gradient-primary me-2 col">
                                    Submit
                                </button>
                            @endif
                            @if ($updateBonus)
                                <button wire:click.prevent="updateBonus()" class="btn btn-gradient-primary me-2 col">
                                    Save Changes
                                </button>
                            @endif
                            <button wire:click.prevent="cancelBonus()" class="btn btn-danger col">
                                Cancel
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
