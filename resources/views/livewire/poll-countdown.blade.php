<div>
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h5 class="card-title">Time Remaining</h5>
            <div id="countdown" class="fs-1 fw-bold text-danger">
                {{-- Initial render from Livewire --}}
                {{ gmdate('H:i:s', $remainingSeconds) }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // document.addEventListener('livewire:load', function() {
            // Get end time from PHP (in seconds) and convert to JS time (milliseconds)
            const endTime = @json($endTime) * 1000;
            const countdownEl = document.getElementById('countdown');

            let timer = null; // declare timer variable for use in both scope & clearInterval

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = endTime - now;

                // Time is up
                if (distance <= 0) {
                    clearInterval(timer);
                    countdownEl.innerHTML = "Expired";

                    // Optional: tell Livewire that poll expired
                    Livewire.emit('pollExpired');
                    return;
                }

                // Calculate hours, minutes, seconds
                const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((distance / (1000 * 60)) % 60);
                const seconds = Math.floor((distance / 1000) % 60);

                // Format as HH:MM:SS
                countdownEl.innerHTML =
                    String(hours).padStart(2, '0') + ":" +
                    String(minutes).padStart(2, '0') + ":" +
                    String(seconds).padStart(2, '0');
            }

            // Start the countdown
            updateCountdown(); // run once immediately
            timer = setInterval(updateCountdown, 1000); // run every second
            // });
        </script>
    @endpush
</div>
