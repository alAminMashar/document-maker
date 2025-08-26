<div>
    @include('livewire.front-end.polls.components.show-header')
    @include('livewire.front-end.polls.components.all-candidates')
    @include('livewire.front-end.polls.components.style')
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                FingerprintJS.load().then(fp => {
                    fp.get().then(result => {
                        let visitorId = result.visitorId;
                        // Call Livewire method to store fingerprint
                        Livewire.emit('storeFingerprint', visitorId);
                    });
                });
            });
        </script>
    @endpush

</div>
