<div class="offcanvas offcanvas-end" tabindex="-1" id="searchOffCanvas" aria-labelledby="searchOffCanvasLabel">
    <div class="offcanvas-header">
        <h5 id="searchOffCanvasLabel">Filter Customer Feedback</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <form class="forms-sample row">

                <div class="form-group">
                    <label for="filter_position">By Department</label>
                    <select wire:model="filter_position" class="form-control form-control-sm" id="filter_position"
                        @error('filter_position') is-invalid @enderror>
                        <option>Select Option</option>
                        @foreach ($positions as $pos)
                            <option value="{{ $pos->id }}">
                                {{ $pos->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('filter_position')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {{-- <button wire:click.prevent="updateFilter()" class="btn btn-primary btn-block me-2 col">
                        Filter
                    </button> --}}
                    <button wire:click.prevent="cancelFeedback()" class="btn btn-danger btn-block me-2 col">
                        Clear Filter
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@include('livewire.shared.search-bar-with-filter')
