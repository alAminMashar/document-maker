<!--? About Law Start-->
<section class="about-low-area section-padding text-color-bg">
    <div class="container">
        <!-- Candidate Grid -->
        <div class="row">
            @foreach ($candidates as $candidate)
                @include('livewire.front-end.polls.cards.candidate-card-two')
            @endforeach
        </div>
    </div>
</section>
<!-- About Law End-->
