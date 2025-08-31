<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card-container">
        @if ($hasVoted && isset($vote) && $vote->candidate_id == $candidate->id)
            <span class="pro">Voted</span>
        @endif
        <img class="candidate-photo" src="{{ $candidate->image }}" alt="{{ $candidate->name }}" />
        <h3 class="text-light fw-bold">{{ $candidate->name }}</h3>
        <h6 class="text-light fw-bold">{{ $candidate->title }}</h6>
        {{-- <p>Additional description</p> --}}
        <div class="buttons">
            @if ($hasVoted || !$poll->active)
                <p class="card-text mb-3 pb-10">
                    <span class="badge badge-info">
                        {{ number_format($candidate->vote_count) }}&nbsp;
                        Votes
                    </span>
                </p>
            @else
                <a wire:click.prevent="submitVote({{ $candidate->id }})" class="btn btn-success w-100 mt-2">
                    <i class="fas fa-vote-yea me-2"></i>Vote
                </a>
            @endif
        </div>
    </div>
</div>
