<!--? About Law Start-->
<section class="about-low-area pt-50 pb-50 text-color-bg" data-background="{{ asset('assets/img/background/4.png') }}"
    style="background-repeat: no-repeat;background-size: cover;background-position: center;">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="about-caption">
                    <div class="section-tittle mb-35">
                        <span class="success p-0 m-0">
                            Poll
                        </span>
                        <h2 class="text-light">
                            <strong>
                                {{ $poll->title }}
                            </strong>
                        </h2>
                        <hr class="col-2 success hr">
                    </div>
                    <p class="text-light">
                        {{ $poll->description }}
                    </p>
                </div>
                @include('livewire.front-end.polls.components.countdown')
            </div>
        </div>

    </div>
</section>
<!-- About Law End-->
