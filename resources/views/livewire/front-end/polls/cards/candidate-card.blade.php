<div class="card shadow-sm mb-4">
    <div class="card-body text-center">
        <div class="mx-auto rounded-circles overflow-hidden mb-3 border border-3 border-secondary"
            style="width: 100%; height: 250px;">
            <img src="{{ $candidate->image }}" alt="{{ $candidate->name }}" class="img-fluid w-100 h-100 object-fit-cover">
        </div>

        <h5 class="card-title text-dark mb-1">
            {{ $candidate->name }}
        </h5>
        <p class="card-text text-muted mb-3">
            {{ $candidate->title }}
            @if ($hasVoted && isset($vote))
                @if ($vote->candidate_id == $candidate->id)
                    <span class="text-success float-end">
                        <i class="fas fa-check-circle me-2"></i>Voted
                    </span>
                @endif
            @endif
        </p>

        @if ($hasVoted || !$poll->active)
            <p class="card-text text-muted mb-3">
                {{ $candidate->getVoteCount($poll) }}&nbsp; Votes
            </p>
        @else
            <a wire:click.prevent="submitVote({{ $candidate->id }})" class="btn btn-primary w-100 mt-2">
                <i class="fas fa-vote-yea me-2"></i>Vote
            </a>
        @endif
    </div>
</div>

<style>
    /* Custom CSS for finer control or if you want to override Bootstrap defaults */
    .object-fit-cover {
        object-fit: cover;
    }
</style>
