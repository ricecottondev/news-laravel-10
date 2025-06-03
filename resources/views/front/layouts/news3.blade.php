<!-- ------------------------------ layout news headlines  -->
<div>
   <div>
      <div class="headlines small">
         <div class="row g-0">

            <div class="col px-3 col-12 col-md">
               <div class="headlines-item d-flex flex-nowrap column-gap-3">
                  <div class="headlines-img w-25">
                     <div class="ratio ratio-1x1">
                        <img src="" class="object-fit-cover" alt="">
                     </div>
                  </div>
                  <div class="headlines-content w-100">
                     <h5 class="fs-reset">
                        <b class="fw-medium">
                           <a href="{{ url('/news/' . $items[0]->slug) }}" class="text-reset link-hover-underline">
                              {{ $items[0]->title }}
                           </a>
                        </b>
                     </h5>
                     <p><small><small>{{ $items[0]->created_at->diffForHumans() }}</small></small></p>
                  </div>
               </div><!-- headlines item -->
            </div><!-- end col -->

            <div class="col col-12 col-md-auto">
               <hr class="d-md-none">
               <div class="vr h-100 d-none d-md-block"></div>
            </div><!-- end col -->

            <div class="col px-3 col-12 col-md">
               <div class="headlines-item d-flex flex-nowrap column-gap-3">
                  <div class="w-25">
                     <div class="ratio ratio-1x1">
                        <img src="" class="object-fit-cover" alt="">
                     </div>
                  </div>
                  <div class="w-100">
                     <h5 class="fs-reset">
                        <b class="fw-medium">
                           <a href="{{ url('/news/' . $items[1]->slug) }}" class="text-reset link-hover-underline">
                              {{ $items[1]->title }}
                           </a>
                        </b>
                     </h5>
                     <p><small><small>{{ $items[1]->created_at->diffForHumans() }}</small></small></p>
                  </div>
               </div><!-- headlines item -->
            </div><!-- end col -->

            <div class="col col-12 col-md-auto">
               <hr class="d-md-none">
               <div class="vr h-100 d-none d-md-block"></div>
            </div><!-- end col -->

            <div class="col px-3 col-12 col-md">
               <div class="headlines-item d-flex flex-nowrap column-gap-3">
                  <div class="w-25">
                     <div class="ratio ratio-1x1">
                        <img src="" class="object-fit-cover" alt="">
                     </div>
                  </div>
                  <div class="w-100">
                     <h5 class="fs-reset">
                        <b class="fw-medium">
                           <a href="{{ url('/news/' . $items[2]->slug) }}" class="text-reset link-hover-underline">
                              {{ $items[2]->title }}
                           </a>
                        </b>
                     </h5>
                     <p><small><small>{{ $items[2]->created_at->diffForHumans() }}</small></small></p>
                  </div>
               </div><!-- headlines item -->
            </div><!-- end col -->

         </div><!-- end row -->
      </div>
      <div class="px-md-3"><hr></div>
   </div>
</div>
<!-- end headlines -->
