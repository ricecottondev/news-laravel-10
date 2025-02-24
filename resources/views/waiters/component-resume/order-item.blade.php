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

      

       <p class="card-text small mb-0">
         NOTE :
      </p>
      <p>
         {!! $cartitems->attributes->note!!}
      </p>


            <p class="card-text fw-semibold pt-2 mb-2">
               Rp {{  $cartitems->price +  $totaladditional }},-
            </p>
           
         </div>
      </div>
   </div>
</div>
