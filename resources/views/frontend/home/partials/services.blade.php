 <!--? About Law Start-->
 <section class="about-low-area section-padding accent-color-bg">
     <div class="container">
         <div class="section-tittle mb-35 text-center">
             <h2 class="primary-text">
                 Ongoing Polls
             </h2>
         </div>
         <div class="row">
             <div class="owl-carousel owl-theme mt-3 mb-3" id="partners">

                 @foreach ($polls as $poll)
                     <div class="owl-item">
                         <div class="service-card">
                             <h1 class="count">
                                 {{ $poll['count'] }}
                             </h1>
                             <h1 class="title">
                                 {{ $poll['title'] }}
                             </h1>
                             <div class="pluck-card">
                                 {!! $poll['description'] !!}
                             </div>
                             <div class="tint"></div>
                             <div class="background">
                                 <img src="{{ asset($poll['background']) }}" alt="{{ $poll['title'] }}"
                                     title="{{ $poll['title'] }}">
                             </div>
                         </div>
                     </div>
                 @endforeach

             </div>
         </div>
         <div class="row text-center">
             <div class="col-md-12 mt-10">
                 <a href="{{ route('frontend.polls') }}" class="btn btn-secondary">
                     View more
                 </a>
             </div>
         </div>
     </div>
 </section>
 <!-- About Law End-->


 <!-- Services Area End -->
 @push('scripts')
     <script>
         var partners = $('#partners');
         partners.owlCarousel({
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
