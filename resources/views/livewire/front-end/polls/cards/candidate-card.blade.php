<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card candidate-card shadow-sm mb-4 border-0">
        <div class="card-body text-center">
            <div class="candidate-photo">
                <img src="{{ $candidate->image }}" alt="{{ $candidate->name }}">
                @if ($hasVoted && isset($vote) && $vote->candidate_id == $candidate->id)
                    <span class="badge bg-success position-absolute top-0 end-0 m-2">Voted</span>
                @endif
            </div>

            <h5 class="card-title text-dark fw-bold mb-1">{{ $candidate->name }}</h5>
            <p class="card-text text-muted mb-3">{{ $candidate->title }}</p>

            @if ($hasVoted && isset($vote) && $vote->candidate_id == $candidate->id)
                <span class="badge bg-success mb-2"><i class="fas fa-check-circle me-1"></i>Voted</span>
            @endif

            @if ($hasVoted || !$poll->active)
                <p class="card-text text-muted mb-3">
                    {{ $candidate->getVoteCount($poll) }} Votes
                </p>
            @else
                <a wire:click.prevent="submitVote({{ $candidate->id }})" class="btn btn-primary w-100 mt-2">
                    <i class="fas fa-vote-yea me-2"></i>Vote
                </a>
            @endif
        </div>
    </div>
</div>
