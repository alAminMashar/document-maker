 <!--? About Law Start-->
 <section class="about-low-area section-padding text-color-bg">
     <div class="container">
         <div class="row">
             @foreach ($candidates as $candidate)
                 <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                     @include('livewire.front-end.polls.cards.candidate-card')
                 </div>
             @endforeach
         </div>
     </div>
 </section>
 <!-- About Law End-->
