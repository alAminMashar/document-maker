<a href="{{ route('frontend.polls.show', ['poll' => $poll]) }}">
    <div class="property-card">
        <div class="thumbnail">
            <img src="{{ asset('assets/img/backgrounds/' . $poll['image']) }}" alt="Property Name">
        </div>
        <div class="body">
            <h1 class="title">
                {{ $poll['title'] }}
            </h1>
            <h3 class="location">
                <span class="fas fa-map-marker"></span>
                &nbsp;{{ Str::limit($poll['description'], 20, '...') }}
            </h3>
            <span class="size">
                {{ $poll['starting_at'] }}
            </span>
            <span class="price">
                {{ $poll['ending_at'] }}
            </span>
        </div>
    </div>

</a>
