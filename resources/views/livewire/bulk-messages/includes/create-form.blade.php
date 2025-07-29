<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addOption)
                <h4 class="card-title">Add Option</h4>
            @endif
            @if ($updateOption)
                <h4 class="card-title">Update Option Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">

                    <div class="form-group col-12">
                        <label for="title">
                            Title
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Enter title" wire:model.defer="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="description">
                            Description
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" placeholder="Enter description" wire:model.defer="description">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="branch_name">
                            Branch Name
                            <span class="text-muted fw-bold">optional</span>
                        </label>
                        <input type="text" class="form-control @error('branch_name') is-invalid @enderror"
                            id="branch_name" placeholder="Enter branch_name" wire:model.defer="branch_name">
                        @error('branch_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="types">
                            Bank
                            <span class="text-muted fw-bold">optional</span>
                        </label>
                        <select wire:model.defer="bank_id" id="types"
                            class="form-control form-control-sm @error('bank_id') is-invalid @enderror">
                            <option>Select option</option>
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">
                                    {{ $bank->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('bank_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="account_number">
                            Account Number
                            <span class="text-muted fw-bold">optional</span>
                        </label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                            id="account_number" placeholder="Enter account_number" wire:model.defer="account_number">
                        @error('account_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="datalist" class="form-label">
                            Select Customer
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input wire:model.defer="customer_id"
                            class="form-control form-control-sm @error('customer_id') is-invalid @enderror"
                            list="customers_list" id="datalist" placeholder="search customers...">
                        <datalist id="customers_list">
                            @if ($customers->count())
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name . ' - ' . $customer->type['name'] }}
                                    </option>
                                @endforeach
                            @else
                                <option>No Active Customers Available</option>
                            @endif
                        </datalist>
                        @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-6">
                        <label for="priorities">
                            Select a Priority
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <select wire:model.defer="payroll_priority_id"
                            class="form-control form-control-sm @error('payroll_priority_id') is-invalid @enderror"
                            id="priorities">
                            <option>Select Option</option>
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}">
                                    {{ $priority->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('payroll_priority_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12" wire:loading.remove>
                            @if ($addOption)
                                <button wire:click.prevent="storeOption()" class="btn btn-gradient-primary me-2 col">
                                    Submit
                                </button>
                            @endif
                            @if ($updateOption)
                                <button wire:click.prevent="updateOption()" class="btn btn-gradient-primary me-2 col">
                                    Save Changes
                                </button>
                            @endif
                            <button wire:click.prevent="cancelOption()" class="btn btn-danger col">
                                Cancel
                            </button>
                        </div>
                        <div class="col-12" wire:loading.block>
                            <span wire:loading.block>
                                <i class="mdi mdi-loading mdi-spin"></i>
                                Loading, please wait...
                            </span>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
