@extends('waiters/layout')

@section('konten')
<style>
/* * {outline: solid 1px green;} */

.order-item:last-of-type .card {
   border-bottom: 0 !important;
}

.order-item:last-of-type .card.pb-3 {
   padding-bottom: 0 !important;
}

.order-item.mb-3:last-of-type {
   margin-bottom: 0!important;
}
</style>

<header class="text-bg-light border-top border-bottom border-dark-subtle sticky-top shadow">
   <div class="container py-4">
      <div class="row">
         <div class="col">
            <h3 class="fw-bold text-capitalize fs-4 mb-0">
               <!-- jika account active / user menginputkan nama sebagai tamu (guest) wording "my" hilang digantikan nama user -->
               <span>my</span>
               <!-- <span>Pradhokot</span> -->
               <span>order,</span>
            </h3>
         </div>
         <div class="col col-auto">
            <div class="fs-5 fw-medium"><span>{{ Auth::user()->name }}</span></div>
         </div>
      </div>
   </div>
</header>

<main class="wrapper" style="padding-bottom: 275.92px;">

   <section>
      <div class="container">
         <div id="order-list" class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            @foreach ($product as $cartitems)  
            @if (strpos($cartitems->id, 'menu-') !== false)
            <div class="col order-item mb-3">
             
               @include('waiters/component/order-item')
             
            </div>  
            @endif
            @endforeach
            {{-- <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div>
            <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div> --}}
            {{-- <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div>
            <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div>
            <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div>
            <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div>
            <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div>
            <div class="col order-item mb-3">
               @include('waiters/component/order-item')
            </div> --}}

         </div>
         <div class="text-end pt-5">
            <a href="{{ url('menu') }}" class="btn text-bg-dark">
               <i class="bi bi-plus"></i> Add More Items
            </a>
         </div>
      </div>
   </section>

   <section class="bg-dark-subtle d-none">
      <div class="container py-4 text-center">
         <a href="#" class="text-dark text-decoration-none">
            <i class="bi bi-tag-fill me-1"></i>
            Add voucher or discount code
         </a>
      </div>
   </section>

</main>

<nav class="text-bg-light border-top border-dark-subtle fixed-bottom">
   <div class="container py-3">
      <div class="mx-auto" style="width: 100%; max-width: 460px;">
         <div class="row row-cols-2 gx-2 d-none">
            <div class="col">
               <button class="btn btn-outline-dark w-100 active">Dine-In</button>
            </div>
            <div class="col">
               <button class="btn btn-outline-dark w-100">Takeaway</button>
            </div>
         </div>
         
         @foreach ($product as $item)
             
         @endforeach
         <div class="row row-cols-2">
            <div class="col">Subtotal</div>
            <div class="col d-flex justify-content-between">
               <span>Rp</span>
               <span>{{ Cart::getSubTotalWithoutConditions() }},-</span>
            </div>
         </div>
         {{-- <div class="row row-cols-2">
            <div class="col">Voucher</div>
            <div class="col text-end">
               <span>(- Rp 25.000,-)</span>
            </div>
         </div> --}}
         <div class="row row-cols-2">
            <div class="col">Tax</div>
            <div class="col d-flex justify-content-between">
               <span>Rp</span>
               <span>{{ $tax }},-</span>
            </div>
         </div>
         <hr class="mt-1 mb-2 border border-dark">
         <div class="row row-cols-2 fw-medium" style="font-size: 1.125rem; margin-bottom: .75rem;">
            <div class="col">Total</div>
            <div class="col d-flex justify-content-between">
               <span>Rp</span>
               <span>{{ Cart::getTotal() }},-</span>
            </div>
         </div>
         {{-- <a class="btn text-bg-dark w-100 btn-lg position-relative" href="/checkout" onclick="confirmAction()">
            Checkout <i class="bi bi-chevron-right"></i>
         </a> --}}
         <form method="POST" onsubmit="return confirm('Apakah anda yakin dengan pesanan anda? tekan tombol OK untuk pembayaran, tekan tombol cancel untuk merubah pesanan anda');" action="/checkout">
            @csrf
            <input type="hidden" name="checkout" value="true"/>
            <input type="submit" class="btn text-bg-dark w-100 btn-lg position-relative" value="Checkout"/>
         </form>

        

      </div>
   </div>
</nav>


@endsection

<script>
 
   //  window.onbeforeunload = function() {
   //      return "Dude, are you sure you want to leave? Think of the kittens!";
   //  }

   // The function below will start the confirmation dialog
   function confirmAction() {
     let confirmAction = confirm("Transaksi tidak bisa di batalkan, tekan OK untuk melanjutkan transaksi pembayaran, tekan cancel untuk merubah pesanan");
     if (confirmAction) {
       alert("Action successfully executed");
     } else {
      //  alert("Action canceled");
     }
   }
 </script>


{{-- @include('waiters/component/modal-detail') --}}

@foreach ($product as $modalitem)
  
      @include('waiters/component/modal-cart-detail')
 
@endforeach
