<div class="dropdown float-ends">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="filterRequests" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="mdi mdi-filter"></span>
        Filter
    </button>
    <ul class="dropdown-menu" aria-labelledby="filterRequests">
        <li>
            <a class="dropdown-item text-primary" wire:click="changeFilter({{ 1 }})">
                {{ isset($active_deployments_count) }} Deployment Requests
            </a>
        </li>
        <li>
            <a class="dropdown-item text-primary" wire:click="changeFilter({{ 2 }})">
                {{ isset($active_onboarding_count) }} Onboarding Requests
            </a>
        </li>
        <li>
            <a class="dropdown-item text-primary" wire:click="changeFilter({{ 3 }})">
                {{ isset($active_termination_count) }} Dismissal Requests
            </a>
        </li>
        <li>
            <a class="dropdown-item text-primary" wire:click="changeFilter({{ 4 }})">
                {{ isset($active_gear_count) }} Gear Requests
            </a>
        </li>
        <li>
            <a class="dropdown-item text-primary" wire:click="changeFilter({{ 5 }})">
                {{ isset($active_salary_advance_count) }} Salary Advance Requests
            </a>
        </li>
        <li>
            <a class="dropdown-item text-primary" wire:click="changeFilter({{ 6 }})">
                {{ isset($active_inventory_count) }} Inventory Transit Requests
            </a>
        </li>
    </ul>
</div>
