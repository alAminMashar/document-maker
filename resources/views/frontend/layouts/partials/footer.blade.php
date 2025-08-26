<div class="elfsight-app-5ae8132c-ebc3-4113-b80b-d2c51673035f" data-elfsight-app-lazy></div>
<footer>
    <div class="footer-wrapper section-bg2" data-background="{{ asset('assets/img/backgrounds/grey.png') }}">
        {{-- <div class="footer-wrapper primary-text-bg"> --}}
        <!-- Footer Top-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <div class="footer-tittle">
                                    <div class="footer-logo mb-20">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('assets/img/logo/logo.png') }}"
                                                alt="organisation logo"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Contact Info</h4>
                                <ul>
                                    <li>
                                        <p>
                                            <span class="fa fa-map-marker"></span>
                                            {{ config('app.address') }}
                                        </p>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            @include('frontend.navigation.site-map')
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Get In Touch</h4>
                                <div class="footer-pera footer-pera2">
                                    <p>
                                        Do you have any inquiries of feedback about our services. Please feel free
                                        to
                                        reach out
                                    </p>
                                    <a href="#" class="btn">
                                        Get In Touch
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-xl-8 col-lg-8 ">
                            <div class="footer-copy-right">
                                <p>
                                    &copy; {{ date('Y') . ' ' . config('app.name') }}. All rights reserved.
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 d-none
                        ">
                            <div class="footer-social f-right d-nones">
                                <a href="https://x.com" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.linkedin.com" target="_blank">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="https://www.instagram.com" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://www.youtube.com/" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="https://www.tiktok.com/" target="_blank">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
