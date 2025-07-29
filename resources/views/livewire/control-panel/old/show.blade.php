<div>

    @include('livewire.control-panel.components.search-canvas')

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 0 ? 'active text-info' : 'text-dark' }} fw-bold" id="all-tab"
                data-bs-toggle="tab" data-bs-targetsssss="#all" type="button" role="tab" aria-controls="all"
                aria-selected="true" wire:click="touchTab({{ 0 }})">
                <span class="badge badge-dark text-light">
                    {{ $pending_count }}
                </span>
                All
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 1 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="deployments-tab" data-bs-toggle="tab" data-bs-targetsssss="#deployments" type="button"
                role="tab" aria-controls="deployments" aria-selected="false"
                wire:click="touchTab({{ 1 }})">
                <span class="badge badge-dark text-light">
                    {{ $deployments_count }}
                </span>
                Deployments
            </button>
        </li>

        <li class="nav-item d-none" role="presentation">
            <button class="nav-link {{ $active_tab == 4 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="onboarding-tab" data-bs-toggle="tab" data-bs-targetsssss="#onboarding" type="button" role="tab"
                aria-controls="onboarding" aria-selected="false" wire:click="touchTab({{ 4 }})">
                <span class="badge badge-dark text-light">
                    {{ $onboarding_count }}
                </span>
                Onboarding
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 3 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="inventory-tab" data-bs-toggle="tab" data-bs-targetsssss="#inventory" type="button" role="tab"
                aria-controls="inventory" aria-selected="false" wire:click="touchTab({{ 3 }})">
                <span class="badge badge-dark text-light">
                    {{ $inventory_count }}
                </span>
                Transit
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 2 ? 'active text-info' : 'text-dark' }} fw-bold" id="gear-tab"
                data-bs-toggle="tab" data-bs-targetsssss="#gear" type="button" role="tab" aria-controls="gear"
                aria-selected="false" wire:click="touchTab({{ 2 }})">
                <span class="badge badge-dark text-light">
                    {{ $gear_count }}
                </span>
                Gear
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 5 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="termination-tab" data-bs-toggle="tab" data-bs-targetsssss="#termination" type="button"
                role="tab" aria-controls="termination" aria-selected="false"
                wire:click="touchTab({{ 5 }})">
                <span class="badge badge-dark text-light">
                    {{ $termination_count }}
                </span>
                Dismissal
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 6 ? 'active text-info' : 'text-dark' }} fw-bold" id="salary-tab"
                data-bs-toggle="tab" data-bs-targetsssss="#salary" type="button" role="tab" aria-controls="salary"
                aria-selected="false" wire:click="touchTab({{ 6 }})">
                <span class="badge badge-dark text-light">
                    {{ $salary_advance_count }}
                </span>
                Advances
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 8 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="salary-allowances-tab" data-bs-toggle="tab" data-bs-targetsssss="#salary-allowances" type="button"
                role="tab" aria-controls="salary-allowances" aria-selected="false"
                wire:click="touchTab({{ 8 }})">
                <span class="badge badge-dark text-light">
                    {{ $salary_allowance_count }}
                </span>
                Allowances
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 7 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="charge_sheet_tab" data-bs-toggle="tab" data-bs-targetsssss="#charge_sheet" type="button"
                role="tab" aria-controls="charge_sheet" aria-selected="false"
                wire:click="touchTab({{ 7 }})">
                <span class="badge badge-dark text-light">
                    {{ $active_charges_count }}
                </span>
                Deductions
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 9 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="salary_change_tab" data-bs-toggle="tab" data-bs-targetsssss="#salary_change" type="button"
                role="tab" aria-controls="salary_change" aria-selected="false"
                wire:click="touchTab({{ 9 }})">
                <span class="badge badge-dark text-light">
                    {{ $salary_charges_count }}
                </span>
                Salary Changes
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $active_tab == 10 ? 'active text-info' : 'text-dark' }} fw-bold"
                id="bank_accounts_tab" data-bs-toggle="tab" data-bs-targetsssss="#bank_accounts" type="button"
                role="tab" aria-controls="bank_accounts" aria-selected="false"
                wire:click="touchTab({{ 10 }})">
                <span class="badge badge-dark text-light">
                    {{ $bank_accounts_count }}
                </span>
                Accounts
            </button>
        </li>

        @if (auth()->user()->hasRole('Super Admin'))
            <li class="nav-item">
                <button class="btn btn-primary btn-sm" type="button" wire:click="runMaintenance()">
                    Run Maintenance
                </button>
            </li>
        @endif


    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade {{ $active_tab == 0 ? 'show active' : '' }}" id="all" role="tabpanel"
            aria-labelledby="all-tab">
            @include('livewire.control-panel.components.all')
        </div>

        <div class="tab-pane fade {{ $active_tab == 1 ? 'show active' : '' }}" id="deployments" role="tabpanel"
            aria-labelledby="deployments-tab">
            @include('livewire.control-panel.components.deployments')
        </div>

        <div class="tab-pane fade {{ $active_tab == 2 ? 'show active' : '' }}" id="gear" role="tabpanel"
            aria-labelledby="gear-tab">
            @include('livewire.control-panel.components.gear')
        </div>

        <div class="tab-pane fade {{ $active_tab == 3 ? 'show active' : '' }}" id="inventory" role="tabpanel"
            aria-labelledby="inventory-tab">
            @include('livewire.control-panel.components.inventory')
        </div>

        <div class="tab-pane fade {{ $active_tab == 4 ? 'show active' : '' }}" id="onboarding" role="tabpanel"
            aria-labelledby="onboarding-tab">
            @include('livewire.control-panel.components.onboarding')
        </div>

        <div class="tab-pane fade {{ $active_tab == 5 ? 'show active' : '' }}" id="termination" role="tabpanel"
            aria-labelledby="termination-tab">
            @include('livewire.control-panel.components.termination')
        </div>

        <div class="tab-pane fade {{ $active_tab == 6 ? 'show active' : '' }}" id="salary" role="tabpanel"
            aria-labelledby="salary-tab">
            @include('livewire.control-panel.components.salary')
        </div>

        <div class="tab-pane fade {{ $active_tab == 7 ? 'show active' : '' }}" id="charge_sheet_tab" role="tabpanel"
            aria-labelledby="charge-tab">
            @include('livewire.control-panel.components.charge')
        </div>

        <div class="tab-pane fade {{ $active_tab == 8 ? 'show active' : '' }}" id="salary-allowances_tab"
            role="tabpanel" aria-labelledby="salary-allowances-tab">
            @include('livewire.control-panel.components.salary-allowances')
        </div>

        <div class="tab-pane fade {{ $active_tab == 9 ? 'show active' : '' }}" id="salary_change_tab"
            role="tabpanel" aria-labelledby="salary-change">
            @include('livewire.control-panel.components.salary_changes')
        </div>

        <div class="tab-pane fade {{ $active_tab == 10 ? 'show active' : '' }}" id="bank_account_tab"
            role="tabpanel" aria-labelledby="salary-change">
            @include('livewire.control-panel.components.bank_accounts')
        </div>

    </div>
</div>
