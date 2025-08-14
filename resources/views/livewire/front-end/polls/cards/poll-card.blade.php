<a href="{{ route('frontend.polls.show', ['poll' => $poll]) }}">
    <div class="property-card">
        <div class="thumbnail">
            <img src="{{ asset($poll['image']) }}" alt="Property Name">
        </div>
        <div class="body">
            <h1 class="title">
                {{ $poll['title'] }}
            </h1>
            <h3 class="location">
                <span class="fas fa-map-marker"></span>
                &nbsp;{{ Str::limit($poll['description'], 20, '...') }}&nbsp;
                <small class="text-info float-end">
                    ({{ $poll->active ? 'Active' : 'In Active' }})
                </small>
            </h3>
            <span class="size">
                Start:&nbsp;{{ \Carbon\Carbon::parse($poll['starting_at'])->format('j/m/y g:i A') }}
            </span>
            <span class="price">
                End:&nbsp;{{ \Carbon\Carbon::parse($poll['ending_at'])->format('j/m/y g:i A') }}
            </span>
        </div>
    </div>

</a>
