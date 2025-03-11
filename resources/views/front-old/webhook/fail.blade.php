@extends('waiters/layout')

@section('konten')
<section style="min-height: 40vh;">
   <div class="container">
      <h1 class="gotham-bold text-danger mb-4">Oops ;-( </h1>
      {{-- <h5 class="mb-4"><strong>Order Number : 63656498#</strong></h5> --}}
      <p style="margin-bottom: 100px;">
         One more step you will get your order. find another favorite product from supresso <a class="text-orange" href="{{url('/menu')}}">here</a> 
      </p>

   </div>
</section>
@endsection