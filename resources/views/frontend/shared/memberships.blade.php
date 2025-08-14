<!--? Services Area Start -->
<div class="service-area section-padding2 section-bg" data-background="{{ asset('assets/img/gallery/section_bg.png') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-80">
                    <h2 class="theme-color">We Are Compliant</h2>
                    <span class="theme-color-2">These are our memberships & accreditations</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel owl-theme mt-0 mb-0" id="memberships">

                @foreach ($memberships as $membership)
                    <div class="owl-item">
                        <div class="partner-card">
                            <img src="{{ asset($membership['logo']) }}" alt="{{ $membership['name'] }}"
                                title="{{ $membership['name'] }}">
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
        var memberships = $('#memberships');
        memberships.owlCarousel({
            margin: 20,
            loop: true,
            autoWidth: true,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: false,
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
                    items: 6
                }
            }
        });
    </script>
@endpush
