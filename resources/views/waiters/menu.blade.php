@extends('waiters/layout')

@section('konten')
<style>
/* * {outline: solid 1px green;} */

.menu-item:last-of-type .card {
   border-bottom: 0!important;
}

.menu-item.out-stock .card-img::after {
   content: 'Out Of Stock!';
   position: absolute;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   /* background-color: rgba(255, 255, 255, .875); */
   /* color: #323232; */
   background-color: rgba(206, 167, 135, .875);
   color: #70421d;
   z-index: 100;
   display: flex;
   justify-content: center;
   align-items: center;
   padding: 1rem;
   text-align: center;
   font-size: 120%;
   font-family: 'gotham medium';
   line-height: normal;
}

.menu-item.out-stock a {
   pointer-events: none!important;
}

.menu-item.out-stock .card-body {
   opacity: .5;
}
</style>

<header class="text-bg-light border-top border-bottom border-dark-subtle sticky-top shadow">
   <div class="container py-4">
      <div class="row row-cols-1 row-cols-md-auto flex-md-nowrap gy-2 gy-md-0 gx-md-3">
         <div class="col">
            <select name="" id="" class="form-select">
               <option value="1">Coffee</option>
               <option value="2">Beverage</option>
               <option value="3">Western Food</option>
               <option value="4">Indonesian Food</option>
            </select>
         </div>
         <div class="col">
            <div class="overflow-x-auto">
               <nav class="text-nowrap text-capitalize">
                  <a class="btn btn-outline-dark active" href="#">
                     manual brew
                  </a>
                  <a class="btn btn-outline-dark" href="#">
                     manual brew
                  </a>
                  <a class="btn btn-outline-dark" href="#">
                     manual brew
                  </a>
                  <a class="btn btn-outline-dark" href="#">
                     manual brew
                  </a>
               </nav>
            </div>
         </div>
      </div>
   </div>
</header>

<main class="wrapper sub-category-list" style="padding-bottom: 81px;">

   <section class="sub-category-item">
      <div class="container">
         <h4 class="sub-category-item fw-medium text-capitalize mb-4">
            manual brew
         </h4>
         <div class="menu-list row row-cols-1 row-cols-lg-2 row-cols-xxl-3">

            <!-- menu item -->
            <div class="menu-item col mb-3 out-stock">
               @include('waiters/component/menu-item')
            </div>

            <!-- menu item -->
            <div class="menu-item col mb-3">
               @include('waiters/component/menu-item')
            </div>

            <!-- menu item -->
            <div class="menu-item col mb-3">
               @include('waiters/component/menu-item')
            </div>

            <!-- menu item -->
            <div class="menu-item col mb-3">
               @include('waiters/component/menu-item')
            </div>

         </div>
      </div>
   </section>

   <section class="sub-category-item">
      <div class="container">
         <h4 class="sub-category-item fw-medium text-capitalize mb-4">
            manual brew
         </h4>
         <div class="menu-list row row-cols-1 row-cols-lg-2 row-cols-xxl-3">

            <!-- menu item -->
            <div class="menu-item col mb-3 out-stock">
               @include('waiters/component/menu-item')
            </div>

            <!-- menu item -->
            <div class="menu-item col mb-3">
               @include('waiters/component/menu-item')
            </div>

            <!-- menu item -->
            <div class="menu-item col mb-3">
               @include('waiters/component/menu-item')
            </div>

            <!-- menu item -->
            <div class="menu-item col mb-3">
               @include('waiters/component/menu-item')
            </div>

         </div>
      </div>
   </section>

</main>

@endsection

@include('waiters/component/modal-detail')
