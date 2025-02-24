<nav id="navdown-tocart" class="text-bg-light border-top border-dark-subtle fixed-bottom shadow">
   <div class="container py-3">
      <div class="mx-auto" style="width: 100%; max-width: 460px;">
         {{-- @if (Cart::getTotalQuantity()!=0) --}}
         {{-- <a class="btn text-bg-dark w-100 btn-lg position-relative" href="{{ url('/cart') }}">
            <span>View Order</span>
            <span class="badge position-absolute top-50 translate-middle-y start-0 ms-3" style="background-color: #fd4f00;">
               {{ Cart::getTotalQuantity() }}
            </span>
         </a>  --}}
         {{-- @endif --}}
         <nav class="nav flex-nowrap nav-justified">
            <a href="https://www.supresso.com/int/public" class="nav-link">
            <img src="https://www.supresso.com/int/public/files/navdown/house.svg" alt="">
            </a>
            <a href="https://www.supresso.com/int/public/fproducts" class="nav-link active">
            <img src="https://www.supresso.com/int/public/files/navdown/bijikopi.svg" alt="">
            </a>
            <a data-bs-toggle="modal" data-bs-target="#tes" class="nav-link">
            <img src="https://www.supresso.com/int/public/files/navdown/list.svg" alt="">
            </a>
            <a href="https://www.supresso.com/int/public/member/board" class=" nav-link ">
            <img src="https://www.supresso.com/int/public/files/navdown/person.svg" alt="">
            </a>
           
         </nav>
      </div>
   </div>
</nav>

{{-- @include('waiters/component/nav-tocart') --}}






<style>
#modal-detail-menu.fade .modal-dialog {
   transform: translate(0,50px);
}

#modal-detail-menu.show .modal-dialog {
   transform: none;
}
</style>


