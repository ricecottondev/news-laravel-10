<a data-bs-toggle="modal" href="#modal-detail-menu{{ $item->id }}" class="text-decoration-none">
   <div class="card bg-light border-start-0 border-top-0 border-end-0 rounded-0 border-bottom-lg-0">
      <div class="row g-0">
         <div class="col col-auto">
            <div class="card-img overflow-hidden position-relative">


               @php
               $urlImgError = url('files/' . 'imagenotavailable.jpg');

               if (!empty($item->fileimages)) {
                     $image = json_decode($item->fileimages);
               } else {
                     $image = "";
               } 
               
               @endphp

               @if ($image == "")
                     <img src="{{ url('files/' . 'imagenotavailable.jpg') }}" class="img-fluid" style="width: 30vw; max-width: 125px;" alt="">
               @else
                     <img src="{{ url('files/product-images/'.$image[0]) }}" class="img-fluid" style="width: 30vw; max-width: 125px;" alt="">
               @endif

               {{-- <img src="../waiters-assets/img/produk/supresso-brew.png" class="img-fluid" style="width: 30vw; max-width: 125px;" alt=""> --}}
            </div>
         </div>
         <div class="col">
            <div class="card-body pt-0 pe-0">
               <h6 class="card-title text-capitalize small mb-1">
                  {{ $category[0]->name }} &nbsp;&nbsp;&nbsp; {{ $submenu->name }}
               </h6>
               <h6 class="card-title text-capitalize fw-semibold">
                  {{ $item->name }}
               </h6>
               <p class="card-text small mb-0" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden;">
                  {{ $item->description }}
               </p>
               <p class="card-text small">
                  <span class="text-decoration-underline">More Detail</span>
                  <i class="bi bi-chevron-right"></i>
               </p>
               <p class="card-text fw-semibold">{{ $item->price }} K</p>
            </div>
         </div>
      </div>
   </div>
</a>

@php
                     
// $test3 = '{item0:{"id":5,"name":"NASI JAGUNG","price":12000},item1:{"id":6,"name":"NASI MERAH","price":12000},item2:{"id":7,"name":"NASI PUTIH","price":12000}}';
// $jsn = json_decode($test3);

//dd($jsn);
@endphp

