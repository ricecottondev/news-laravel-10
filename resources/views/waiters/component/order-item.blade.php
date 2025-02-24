<div class="card bg-light border-start-0 border-top-0 border-end-0 rounded-0 pb-3 border-bottom-md-0">
   <div class="row gy-0 gx-3">
      <div class="col-4">
         @if ($cartitems->attributes->images=="imagenotavailable.jpg")
         <img src="{{ url('files/imagenotavailable.jpg')}}" class="card-img" alt="">
         @else
         <img src="{{ url('files/product-images/')."/".$cartitems->attributes->images }}" class="card-img" alt="">
         @endif
        
      </div>
      @php
         // dump($cartitems);
      @endphp
      <div class="col-8">
         <div class="card-body p-0">
            {{-- <h6 class="card-title text-capitalize small mb-1 opacity-75">
               {{  $cartitems->attributes->category }} &nbsp;&nbsp;&nbsp; {{  $cartitems->attributes->subcategory }}
            </h6> --}}
            <h6 class="card-title text-capitalize fw-semibold mb-1">
               {{  $cartitems->attributes->brand }}-{{  $cartitems->name }}
            </h6>
            <p class="card-text small mb-2">
               Qty. {{  $cartitems->quantity }}
            </p>

            <p class="card-text small mb-0">
               ADDITIONAL :
               @php
               $array = $cartItems;
               $iditems = str_replace('menu-', '', $cartitems->id);
               $index = 0
               @endphp
            </p>

           
            @php
               $totaladditional =0;
            @endphp
            @foreach ($array as $additional)
            @if ((strpos($additional->id, $iditems) !== false)&&(strpos($additional->id, "add") !== false))
               @if ($index==0)
               {{ strtolower($additional->name) }} 
               @else
               | {{ strtolower($additional->name) }} 
               @endif
               
               @php
               $totaladditional =  $totaladditional + $additional->price; 
               @endphp
               
               {{-- <form action="{{ route('cart.remove') }}" method="POST"  id="formdeleteadditionalcart{{ $additional->id }}">
                  @csrf
                  <input type="hidden" value="{{ $additional->id }}" name="id">
                  <a class="text-dark text-decoration-none" onclick="document.getElementById('formdeleteadditionalcart{{ $additional->id }}').submit()">
                     <u><i class="bi bi-x-circle"></i></u> Delete
                  </a>
               </form> --}}
            @endif 
            @php $index++ @endphp
         @endforeach

         {{-- @foreach ($array as $additional)
                  @php
                     if ((strpos($additional->id, "add") !== false)&&(strpos($additional->id, $iditemswithoutmenu) !== false)) {
                     $explode_code_additional =  (explode("|",$additional->id));
                     $code_additional = $explode_code_additional;
                     $get_id_additioinal =  (explode("-",$code_additional[0]));
                     $id_additional = $get_id_additioinal[1];
                
                     array_push($aditionalchoosen, $id_additional);
                     }
               
                  @endphp
                  
         @endforeach --}}

         {{-- @foreach ($modalitem->additional as $additional)
         <li class="list-group-item px-0">
            <div class="form-check">
               @php
                  # filter berdasarkan id
                  $additionanlId = $additional->id;
                  $filteredArray = array_filter($aditionalchoosen, function($key) use ($additionanlId) {
                     $isFound = $key == $additionanlId;
                     return $isFound;
                  });
                  # jika ada maka true
                  $isAvailable = count($filteredArray) > 0; 
                  if ($isAvailable) {
                     $totaladditional =  $totaladditional + $additional->price;
                  }
                 
               @endphp
               <input {{ $isAvailable ? "checked" : "" }} onclick="myFunction<?php echo $iditems ?>('{{ $iditems}}')" name="additionaloption{{ $modalitem->id }}[]" type="checkbox" class="form-check-input rounded-circle bg-dark border-dark" value='{"id":{{ $additional->id }}, "name":"{{ $additional->name }}", "price":{{ $additional->price }} }' id="mods{{ $additional->id }}" >
               <label for="mods1" class="form-check-label d-flex flex-nowrap justify-content-between">
                  <div><span>{{ $additional->name }}</span></div>
                  <div class="d-inline-flex flex-nowrap justify-content-between" style="width: 42%;">
                     <span>+&nbsp;Rp&nbsp;</span>
                     <span>{{ $additional->price }};-</span>
                  </div>
               </label>
            </div>
         </li>
       @endforeach --}}

       <p class="card-text small mb-0">
         NOTE :
      </p>
      <p>
         {!! $cartitems->attributes->note!!}
      </p>


            <p class="card-text fw-semibold pt-2 mb-2">
               Rp {{  $cartitems->price +  $totaladditional }},-
            </p>
            <p class="card-text">             
               <form action="{{ route('cart.remove') }}" method="POST"  id="formdeleteitemscart{{ $cartitems->id }}">
                  <a data-bs-toggle="modal" href="#modal-cart-detail-menu{{ $cartitems->id }}" class="text-dark me-3">
                     <u><small>EDIT</small></u> <i class="bi bi-pencil-fill"></i>
                  </a>
                  @csrf
                  <input type="hidden" value="{{ $cartitems->id }}" name="id">
                  <a class="text-dark" 
                  data-bs-toggle="modal" data-bs-target="#modal-delete-order{{ $cartitems->id }}"
                  {{-- onclick="document.getElementById('formdeleteitemscart{{ $cartitems->id }}').submit()"  --}}
                  style="cursor: pointer !important;">
                     <u><small>DELETE</small></u> <i class="bi bi-trash2-fill"></i>
                  </a>
                  {{-- <button class="text-dark text-decoration-none"><u><small>DELETE</small></u> <i class="bi bi-trash2-fill"></i></button> --}}
              </form>
            </p>
         </div>
      </div>
   </div>
</div>

<div id="modal-delete-order{{ $cartitems->id }}" class="modal fade center" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h6 class="modal-title">Deleted Item</h6>
            <button class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <div class="modal-body">
            <h5>Are you sure want to delete this item?</h5>
         </div>
         <div class="modal-footer border-0">
            <button class="btn text-bg-secondary" data-bs-dismiss="modal">Cancel</button>
            <button onclick="document.getElementById('formdeleteitemscart{{ $cartitems->id }}').submit()" class="btn text-bg-dark">Deleted</button>
         </div>
      </div>
   </div>
</div>