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
               <span>Resume</span>
               <!-- <span>Pradhokot</span> -->
               <span>order</span>
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
             
               @include('waiters/component-resume/order-item')
             
            </div>  
            @endif
            @endforeach
         

         </div>
         <div class="text-end pt-5 d-none">
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
        
         <div class="row row-cols-2 gx-2 ">
            Invoice : {{ $nomerOrder}}
         </div> 
         <div class="row row-cols-2 gx-2 fw-medium">
           
             Please go to the cashier to pay for your order, or press button Online Payment to pay onlines
            
        
         </div> 
         <form onsubmit="return confirm('Apakah anda yakin dengan pesanan anda? tekan tombol OK untuk pembayaran, tekan tombol cancel untuk merubah pesanan anda');" action="/checkout">
         {{-- <input type="submit" class="btn text-bg-dark w-100 btn-lg position-relative" value="Online Payment"/> --}}
         </form>

         <button class="btn text-bg-dark w-100 btn-lg position-relative" onClick="paymentonline()">Proceed to Payment</button>
         <hr>

        
         @foreach ($product as $item)
             
         @endforeach
         <div class="row row-cols-2">
            <div class="col">Subtotal</div>
            <div class="col d-flex justify-content-between">
               <span>Rp</span>
               {{-- <span>{{ Cart::getSubTotalWithoutConditions() }},-</span> --}}
               <span>{{ $subtotalwithoutconditions}},-</span>
            </div>
         </div>
      
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
               {{-- <span>{{ Cart::getTotal() }},-</span> --}}
               <span>{{ $total }},-</span>
            </div>
         </div>
         <a class="btn text-bg-dark w-100 btn-lg position-relative d-none" href="/waiters/checkout">
            Checkout <i class="bi bi-chevron-right"></i>
         </a>
      </div>
   </div>
</nav>

<div id="modal-delete-order" class="modal fade center" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
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
            <button class="btn text-bg-dark">Deleted</button>
         </div>
      </div>
   </div>
</div>
@endsection

{{-- @include('waiters/component-resume/modal-detail') --}}

{{-- @foreach ($product as $modalitem)
  
      @include('waiters/component-resume/modal-cart-detail')
 
@endforeach --}}
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-SYRIDptTg-TbJP0j"></script>
{{-- <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-7jHGz48eBsLakCja"></script> --}}
<script>
   const baseapi = "{{ URL::to('/') }}";
   let merchant = "midtrans";
   
   var nomerOrder = "{{ $nomerOrder }}";
   var totalOrder = "{{ $total }}";
   
   console.log(nomerOrder);
   function paymentonline(){
      $('#loading').collapse('show');
            $.ajax({
                url: baseapi + "/payment",
                method: "POST",
                data: {
                    "_token": "{{ @csrf_token() }}",
                    "merchant": merchant,
                    "nomerOrder" : nomerOrder,
                    "total" : totalOrder,
                    "data": "[]",
                },
                success: function(res) {
                    // const result = JSON.parse(res);
                    $('#loading').collapse('hide');
                    console.log(res);

                    // showing snap midtrans
                    snap.pay(res.data.token, {
                        onSuccess: function(result) {
                            $('#loading').collapse('show');
                            console.log('success');
                            console.log(result);
                            window.location.replace(baseapi + "/payment-success/" + res.token);
                        },
                        onPending: function(result) {
                            $('#loading').collapse('show');
                            // console.log('customer closed the popup without finishing the payment');
                            window.location.replace(baseapi + "/payment-fail/");
                        },
                        onError: function(result) {
                            $('#loading').collapse('show');
                            // console.log('customer closed the popup without finishing the payment');
                            window.location.replace(baseapi + "/payment-fail/");
                            // console.log('error');
                            // console.log(result);
                        },
                        onClose: function() {
                            $('#loading').collapse('show');
                            console.log(
                                'customer closed the popup without finishing the payment');
                            window.location.replace(baseapi + "/payment-fail/");
                        }
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            });

   }
</script>