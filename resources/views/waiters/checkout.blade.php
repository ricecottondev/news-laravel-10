@extends('waiters/layout')

@section('konten')
<header class="text-bg-light border-top border-bottom border-dark-subtle sticky-top shadow">
   <div class="container py-4">
      <div class="row">
         <div class="col">
            <h3 class="fw-bold text-capitalize fs-4 mb-0">Checkout</h3>
         </div>
         <div class="col col-auto">
            <div class="fs-5 fw-medium"><span>Table 3</span></div>
         </div>
      </div>
   </div>
</header>

<main class="wrapper">
   <div class="container">
      <form action="">

         <section class="mb-5">
            <h6 class="fw-semibold mb-3">Your details</h6>
            <div class="mb-3">
               <input type="text" class="form-control rounded-0 px-0 border-start-0 border-top-0 border-end-0" placeholder="Name">
            </div>
            <div class="mb-3">
               <input type="email" class="form-control rounded-0 px-0 border-start-0 border-top-0 border-end-0" placeholder="Email">
            </div>
         </section>

         <section class="mb-5">
            <h6 class="fw-semibold mb-3">Select your payment method</h6>
            <div class="row row-cols-1 row-cols-md-2 gy-2 gy-md-0 gx-md-2">
               <div class="col">
                  <div class="form-check form-check-reverse border rounded border-dark-subtle">
                     <input class="form-check-input bg-dark border-dark" type="radio" name="flexRadioDefault" id="payment-card">
                     <label class="form-check-label w-100 text-start p-2" for="payment-card">
                        <i class="bi bi-credit-card-fill"></i> Credit Card
                     </label>
                  </div>
               </div>
               <div class="col">
                  <div class="form-check form-check-reverse border rounded border-dark-subtle">
                     <input class="form-check-input bg-dark border-dark" type="radio" name="flexRadioDefault" id="payment-cash">
                     <label class="form-check-label w-100 text-start p-2" for="payment-cash">
                        <i class="bi bi-cash"></i> Cash
                     </label>
                  </div>
                  <div class="small">
                     <span>*You can pay at the counter</span>
                  </div>
               </div>
            </div>
            <style media="screen">
            .form-check {padding-right: 2rem;}
            .form-check input {margin-top: .725rem;}
            </style>
         </section>

         <section>
            <div class="mx-auto" style="width: 100%; max-width: 460px;">
               <div class="row row-cols-2">
                  <div class="col">Subtotal</div>
                  <div class="col d-flex justify-content-between">
                     <span>Rp</span>
                     <span>150.000,-</span>
                  </div>
               </div>
               <div class="row row-cols-2">
                  <div class="col">Voucher</div>
                  <div class="col text-end">
                     <span>(- Rp 25.000,-)</span>
                  </div>
               </div>
               <div class="row row-cols-2">
                  <div class="col">Tax</div>
                  <div class="col d-flex justify-content-between">
                     <span>Rp</span>
                     <span>35.000,-</span>
                  </div>
               </div>
               <hr class="mt-1 mb-2 border border-dark">
               <div class="row row-cols-2 fw-medium" style="font-size: 1.125rem; margin-top: .75rem; margin-bottom: .75rem;">
                  <div class="col">Total</div>
                  <div class="col d-flex justify-content-between">
                     <span>Rp</span>
                     <span>125.000,-</span>
                  </div>
               </div>
               <a class="btn text-bg-dark w-100 btn-lg position-relative" href="/waiters/">
                  Pay <i class="bi bi-chevron-right"></i>
               </a>
            </div>
         </section>

      </form>
   </div>
</main>
@endsection
