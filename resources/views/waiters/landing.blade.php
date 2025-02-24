@extends('waiters/layout')

@section('konten')
<style media="screen">
/* * {outline: solid 1px green;} */

.category-list .category-item .card .card-img-overlay {
   bottom: unset;
}

.category-item {
   margin-bottom: 1.5rem;
}

.category-item:last-of-type {
   margin-bottom: 0;
}
</style>

<header class="text-bg-light border-top border-bottom border-dark-subtle sticky-top shadow">
   <div class="container py-4">
      <div class="row">
         <div class="col">
            <h3 class="fw-bold text-capitalize fs-4 mb-0">
               hello,
               <br class="d-md-none">
               <!-- jika account active / user menginputkan nama sebagai tamu (guest) wording "welcome" hilang digantikan nama user -->
               <span>welcome</span>
               <!-- <span>pradhokot</span> -->
            </h3>
         </div>
         <div class="col col-auto">
            <div class="fs-5 fw-medium"><span>{{ Auth::user()->name }}</span></div>
            {{-- <a href="{{ url("/logout") }}" class="menu-link px-5">Sign Out</a> --}}
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
         </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="menu-link">
                @csrf
            </form>
         </div>
      </div>
   </div>
</header>

<main class="wrapper">

   <div class="container">
      <h6 class="mb-4">Category Menu</h6>
      <div class="category-list row row-cols-1 row-cols-lg-2">
         @foreach ($category as $category)
         <!-- category item -->
         <div class="category-item col">
            <a href="/submenu/?menu={{ $category->id }}" class="text-decoration-none">
               <div class="card border-0">
                  <img src="../waiters-assets/img/banner/banner-brew.png" class="card-img" alt="">
                  <div class="card-img-overlay top-50 translate-middle-y">
                     <h4 class="card-title fw-medium text-capitalize text-light mb-0">
                        {{ $category->name }}
                     </h4>
                  </div>
               </div>
            </a>
         </div>
         @endforeach
      </div>
   </div>

</main>

<footer id="copyright">
   <div class="container" style="padding-bottom: 81px;">
      <hr>
      <p class="small text-center text-lg-end opacity-50">&copy; 2023 INDRACO. All rights reserved.</p>
   </div>
</footer>
@endsection


@foreach ($allproduct as $modalitem)
@include('waiters/component/modal-detail')
@endforeach

