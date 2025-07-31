<div>
    @if ($addLetter || $updateLetter)
        @include('livewire.letters.includes.crud-modal')
    @endif

    @include('livewire.letters.components.search')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Letters Manager
                </h4>
                <p class="card-description">
                    @if ($filter)
                        <br>
                        <small class="text-secondary">
                            <b class="text-muted">({{ number_format($result_count) . ' results' }})</b>
                            {{ $filter_description }}
                        </small>
                    @endif
                </p>

                @if (auth()->user()->can('letters.report'))
                    <button wire:click="addLetter()" class="btn btn-info btn-sm float-rights">
                        <i class="mdi mdi-checkbox-marked-outline"></i>
                        Add Letter
                    </button>
                @endif
                <br>
                <br>
                @include('livewire.letters.components.index-table')
            </div>
        </div>
    </div>
</div>
