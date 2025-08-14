 <!--? About Law Start-->
 <section class="about-low-area section-padding text-color-bg">
     <div class="container">
         <div class="section-tittle mb-35">
             <h2 class="text-light">
                 Here are the current ongoing polls
             </h2>
             <hr class="col-2 primary hr">
         </div>
         <div class="row">
             @foreach ($polls as $poll)
                 <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                     @include('livewire.front-end.polls.cards.poll-card')
                 </div>
             @endforeach
         </div>
         <div class="row">
             <div class="col text-center">
                 <a href="{{ route('frontend.polls') }}" class="btn btn-primary">
                     View More
                 </a>
             </div>
         </div>
     </div>
 </section>
 <!-- About Law End-->
