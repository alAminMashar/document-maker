 <!--? About Law Start-->
 <section class="about-low-area section-padding primary-text-bg">
     <div class="container">
         <div class="section-tittle mb-35 text-center">
             <h2 class="primary">
                 Why choose 361 Real Estate?
             </h2>
             <p class="text-light">
                 We consistently prioritize quality, innovation and customer satisfaction.
             </p>
         </div>
         <div class="row">
             <div class="col-lg-4 col-md-6 col-xs-12">
                 @include(
                     'frontend.home.partials.simple-card',
                     $data = [
                         'icon' => 'fa-map-marker',
                         'title' => 'Local Expertise',
                         'description' =>
                             "As a locally-owned company, we have an in-depth understanding of the market trends and neighborhoods in your area. Whether you're buying in the city or the suburbs, we’ll provide expert insight that helps you make informed decisions.",
                     ]
                 )
             </div>

             <div class="col-lg-4 col-md-6 col-xs-12">
                 @include(
                     'frontend.home.partials.simple-card',
                     $data = [
                         'icon' => 'fa-cog',
                         'title' => 'Tailored Services',
                         'description' =>
                             'Every client is unique, and we pride ourselves on offering personalized solutions. Our agents listen carefully to your needs and goals, developing a strategy that is custom-fit to your circumstances.',
                     ]
                 )
             </div>

             <div class="col-lg-4 col-md-6 col-xs-12">
                 @include(
                     'frontend.home.partials.simple-card',
                     $data = [
                         'icon' => 'fa-lightbulb',
                         'title' => 'Cutting-Edge Technology',
                         'description' =>
                             'We leverage the latest technology to streamline the real estate process. From virtual tours to comprehensive market analysis, we ensure you have all the tools needed for a seamless experience.',
                     ]
                 )
             </div>

             <div class="col-lg-4 col-md-6 col-xs-12">
                 @include(
                     'frontend.home.partials.simple-card',
                     $data = [
                         'icon' => 'fa-user-plus',
                         'title' => 'Client-Centered Approach',
                         'description' =>
                             'Your satisfaction is our top priority. We are dedicated to providing transparent, responsive service with integrity at every step. We’re not just here to close deals—we’re here to build lasting relationships and create value for you.',
                     ]
                 )
             </div>

             <div class="col-lg-4 col-md-6 col-xs-12">
                 @include(
                     'frontend.home.partials.simple-card',
                     $data = [
                         'icon' => 'fa-gavel',
                         'title' => 'Readily available legal team',
                         'description' =>
                             'Your satisfaction is our top priority. We are dedicated to providing transparent, responsive service with integrity at every step. We’re not just here to close deals—we’re here to build lasting relationships and create value for you.',
                     ]
                 )
             </div>
         </div>
     </div>
 </section>
 <!-- About Law End-->
