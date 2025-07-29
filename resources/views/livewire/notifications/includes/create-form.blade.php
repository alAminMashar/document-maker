<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                {{ App\Models\Helpers::mb_basename($type) }}
            </h4>
            <div class="row">
                <p class="card-description">
                    {{ $data['data'] }}
                </p>
            </div>
            <div class="row">
                <div class="col-12">
                    <button wire:click.prevent="cancelNotification()" class="btn btn-danger btn-xs">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
