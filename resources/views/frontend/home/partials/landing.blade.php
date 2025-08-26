<div class="home-landing-card">
    <img src="{{ asset('assets/img/background/4.png') }}" alt="Home Landing Page Banner">
    <div class="tint"></div>
    <div class="content">
        <h1 class="title">
            <span class="primary">{{ config('app.name') }}</span> <br> From Ballot to Trust, Seamlessly.
        </h1>
        <p class="body">
            Our voting platform is a <b>secure, transparent,</b> and user-friendly digital solution designed to
            streamline the electoral process for political parties.
        </p>
        <a href="{{ route('frontend.polls') }}" class="btn action">
            Browse Home Now
        </a>
        <a href="{{ route('frontend.polls') }}" class="btn highlight-action">
            <span class="fas fa-play"></span>
            Watch Intro
        </a>
    </div>
</div>
