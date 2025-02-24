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
            <div class="fs-5 fw-medium"><span>Table 3</span></div>
         </div>
      </div>
   </div>
</header>

<main class="wrapper" style="padding-bottom: 275.92px;">

   <section>
      <div class="container">
         <div id="order-list" class="row row-cols-1 row-cols-md-2 row-cols-xl-3">

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

         </div>
         <div class="text-end pt-5">
            <a href="/waiters/menu" class="btn text-bg-dark">
               <i class="bi bi-plus"></i> Add More Items
            </a>
         </div>
      </div>
   </section>

   <section class="bg-dark-subtle">
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
         <div class="row row-cols-2 gx-2">
            <div class="col">
               <button class="btn btn-outline-dark w-100 active">Dine-In</button>
            </div>
            <div class="col">
               <button class="btn btn-outline-dark w-100">Takeaway</button>
            </div>
         </div>
         <hr>
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
         <div class="row row-cols-2 fw-medium" style="font-size: 1.125rem; margin-bottom: .75rem;">
            <div class="col">Total</div>
            <div class="col d-flex justify-content-between">
               <span>Rp</span>
               <span>125.000,-</span>
            </div>
         </div>
         <a class="btn text-bg-dark w-100 btn-lg position-relative" href="/waiters/checkout">
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

@include('waiters/component/modal-detail')
