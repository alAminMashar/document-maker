<div class="property-banner d-none d-sm-block">
    <div class="background">
        <img src="{{ asset('assets/img/backgrounds/grey.png') }}" alt="Banner">
    </div>
    <div class="body">
        <h1 class="title">
            {{ $poll->title }}
        </h1>
        <p class="sub-title">
            Start:&nbsp;{{ \Carbon\Carbon::parse($poll['starting_at'])->format('j/m/y g:i A') }}
            &nbsp;
            End:&nbsp;{{ \Carbon\Carbon::parse($poll['ending_at'])->format('j/m/y g:i A') }}
            <small>
                ({{ $poll->active ? 'Active' : 'In Active' }})
            </small>
        </p>
        <!-- Countdown Timer -->
        <p class="sub-title">
            {{ $poll->description }}
        </p>
        @include('livewire.front-end.polls.components.countdown')
    </div>
</div>
