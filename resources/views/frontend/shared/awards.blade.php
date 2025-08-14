<!--? Services Area Start -->
<div class="service-area section-padding2 accent-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-80">
                    <h2 class="theme-color-2">Our Accolades</h2>
                    <span>
                        Our efforts in compliance and industry standard service delivery have been recognised both
                        locally and globally.
                    </span>
                    {{-- We are committed to delivering personalized and effective legal solutions. Our rich history and
                    diverse expertise ensure that we understand your needs and deliver results with integrity and
                    professionalism. --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel owl-theme mt-3 mb-3" id="awards">

                @foreach ($awards as $award)
                    <div class="owl-item">
                        <div class="service-card">
                            <h1 class="count">
                                {{ $award['count'] }}
                            </h1>
                            <h1 class="title">
                                {{ $award['title'] }}
                            </h1>
                            <div class="pluck-card">
                                {{ $award['title'] }}
                                <br>
                                {!! $award['description'] !!}
                            </div>
                            <div class="tint"></div>
                            <div class="background">
                                <img src="{{ asset($award['background']) }}" alt="{{ $award['title'] }}"
                                    title="{{ $award['title'] }}">
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- Services Area End -->
@push('scripts')
    <script>
        var awards = $('#awards');
        awards.owlCarousel({
            margin: 20,
            loop: true,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                960: {
                    items: 5
                },
                1200: {
                    items: 5
                }
            }
        });
    </script>
@endpush
