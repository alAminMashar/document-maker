<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addArticle)
                <h4 class="card-title">Add Article</h4>
            @endif
            @if ($updateArticle)
                <h4 class="card-title">Update Article Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="sub_topic">
                            Sub Topic
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <select wire:model.defer="sub_topic_id"
                            class="form-control form-control-sm @error('sub_topic_id') is-invalid @enderror"
                            id="sub_topic">
                            <option>Select Option</option>
                            @foreach ($sub_topics as $sub_topic)
                                <option value="{{ $sub_topic->id }}">
                                    {{ $sub_topic->topic->title . ' > ' . $sub_topic->title }}
                                </option>
                            @endforeach
                        </select>

                        @error('sub_topic_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

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
                        <label for="body">
                            Body
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="body"
                            placeholder="Enter body" wire:model.defer="body">
                        </textarea>
                        @error('body')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <span class="fw-thin fs-5">
                        Select permissions that can access this article
                    </span>
                    <div class="row p-5">
                        @if ($permissions->count())
                            @foreach ($permissions as $perm)
                                <div class="form-check form-switch col-3">
                                    <input wire:model.defer="selected_permissions.{{ $perm->id }}"
                                        class="form-check-input" type="checkbox" id="{{ $perm->id }}-permSwitch"
                                        value="{{ $perm->id }}">
                                    <label class="form-check-label fw-6" for="{{ $perm->id }}-permSwitch">
                                        {{ $perm->name }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning" role="alert">
                                No permissions available
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" wire:loading.remove>
                        @if ($addArticle)
                            <button wire:click.prevent="storeArticle()" class="btn btn-gradient-primary me-2 col"
                                wire:loading.class="opacity-25">
                                Submit
                            </button>
                        @endif
                        @if ($updateArticle)
                            <button wire:click.prevent="updateArticle()" class="btn btn-gradient-primary me-2 col"
                                wire:loading.class="opacity-25">
                                Save Changes
                            </button>
                        @endif
                        <button wire:click.prevent="cancelArticle()" class="btn btn-danger col">
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

            </form>
        </div>
    </div>
</div>
