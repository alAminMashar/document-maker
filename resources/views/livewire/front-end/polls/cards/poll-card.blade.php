<a href="{{ route('frontend.polls.show', ['poll' => $poll]) }}">
    <div class="property-card">
        <div class="thumbnail">
            <img src="{{ asset($poll['image']) }}" alt="Property Name">
        </div>
        <div class="body">
            <h1 class="title">
                {{ Str::limit($poll['title'], 100, '...') }}
            </h1>
            <h3 class="location">
                <span class="fas fa-clock"></span>
                <small class="">
                    {{ $poll->duration }} Hours
                </small>
            </h3>
            <span class="size">
                ({{ $poll->active ? 'Active' : 'In Active' }})
            </span>
            <span class="price">
            </span>
        </div>
    </div>

</a>
