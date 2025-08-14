@extends('layouts.app')
@section('title')
    Contact Us
@endsection
@section('content')
    <!--?  Contact Area start  -->
    <section class="contact-section primary-text-bg">
        <div class="container">

            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-5 d-nones">
                        <h2 class="primary">Contact Us</h2>
                        <b class="text-light">Our offices are located at</b>
                        <p class="text-light">
                            {{ config('app.offices') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8465818368063!2d36.80190861154297!3d-1.2645749987180677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f173fe3de3041%3A0xbce96eb389f96bf8!2sMpaka%20House%2C%20Woodvale%20Grove%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1739944928295!5m2!1sen!2ske"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="row d-none">
                <div class="col-12">
                    <h2 class="theme-color fw-bold">Get in Touch</h2>
                </div>
                <div class="col-lg-8 d-nones">
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm"
                        novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
                                        placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                        placeholder="Enter Subject">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info theme-color">
                        <span class="contact-info__icon"><i class="ti-home "></i></span>
                        <div class="media-body">
                            <h3 class="theme-color-3">{{ config('app.address') }}</h3>
                        </div>
                    </div>
                    <div class="media contact-info theme-color">
                        <span class="contact-info__icon"><i class="ti-tablet "></i></span>
                        <div class="media-body">
                            <h3 class="theme-color-3">{{ config('app.phone') }}</h3>
                            <p class="theme-color-3">{{ config('app.opening_hours') }}</p>
                        </div>
                    </div>
                    <div class="media contact-info theme-color">
                        <span class="contact-info__icon"><i class="ti-email "></i></span>
                        <div class="media-body">
                            <h3 class="theme-color-3">{{ config('app.email') }}</h3>
                            <p class="theme-color-3">Reach out.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Contact Area End -->

    @include('cta.call-to-action')
@endsection
