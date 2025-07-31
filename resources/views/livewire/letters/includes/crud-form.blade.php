<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addLetter)
                <h4 class="card-title">Add Letter</h4>
            @endif
            @if ($updateLetter)
                <h4 class="card-title">Update Letter Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">

                    <div class="form-group col-6">
                        <label for="serial_number">
                            Serial Number
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                            id="serial_number" placeholder="Enter serial_number" wire:model.defer="serial_number">
                        @error('serial_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="published_at">
                            Publication Date
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="date" class="form-control @error('published_at') is-invalid @enderror"
                            id="published_at" placeholder="Enter publication date" wire:model.defer="published_at">
                        @error('published_at')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

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
                </div>

                <div class="row">
                    <div wire:ignore class="form-group col-12">
                        <textarea id="editor">{!! $content !!}</textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <style>
                        .ck-editor__editable {
                            min-height: 500px;
                            /* Increase this for more space */
                        }
                    </style>
                    <script>
                        tinymce.init({
                            selector: '#editor',
                            plugins: 'lists link image table code',
                            toolbar: 'undo redo | styleselect | bold italic | fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | outdent indent | code',
                            setup: function(editor) {
                                editor.on('Change KeyUp', function() {
                                    @this.set('content', editor.getContent());
                                });
                            }
                        });

                        function syncEditorContent() {
                            if (window.editorInstance) {
                                @this.set('content', window.editorInstance.getData());
                            }
                        }
                    </script>
                </div>


                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="form-check form-switch ms-5">
                                <input class="form-check-input" wire:model.defer="published" type="checkbox"
                                    id="published" @error('published') is-invalid @enderror>
                                <label class="form-check-label" for="published">
                                    Published
                                </label>
                            </div>
                            @error('published')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('published_at')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('published_by')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('created_by')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('published')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" wire:loading.remove>
                        @if ($addLetter)
                            <button wire:click.prevent="storeLetter()" class="btn btn-gradient-primary me-2 col"
                                wire:loading.class="opacity-25">
                                Submit
                            </button>
                        @endif
                        @if ($updateLetter)
                            <button wire:click.prevent="updateLetter({{ $letterID }})"
                                class="btn btn-gradient-primary me-2 col" wire:loading.class="opacity-25">
                                Save Changes
                            </button>
                        @endif
                        <button wire:click.prevent="cancelLetter()" class="btn btn-danger col">
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
