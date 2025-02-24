<nav id="navdown-tocart" class="text-bg-light border-top border-dark-subtle fixed-bottom shadow">
   <div class="container py-3">
      <div class="mx-auto" style="width: 100%; max-width: 460px;">
         <a class="btn text-bg-dark w-100 btn-lg position-relative" href="{{ url('/cart') }}">
            <span>View Order</span>
            <span class="badge position-absolute top-50 translate-middle-y start-0 ms-3" style="background-color: #fd4f00;">
               {{ Cart::getTotalQuantity() }}
            </span>
         </a>
      </div>
   </div>
</nav>
