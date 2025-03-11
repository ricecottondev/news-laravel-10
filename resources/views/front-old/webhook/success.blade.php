@extends('waiters/layout')

@section('konten')
<section style="min-height: 40vh;">
   <div class="container">
      <h1 class="gotham-bold mb-4">Thank you.</h1>
      <h5 class="mb-4"><strong>Order Number : {{ $nomerOrder }}</strong></h5>
      <p style="margin-bottom: 100px;">
         Your payment has been successfully received, and you will receive an e-mail confirmation of your order at . Do let us know if we can help you in any other way!
      </p>

      {{-- <p class="mb-4">Save your information for next time.</p>

      <form action="" class="mb-5" style="max-width: 480px;">
         <div class="form-group border-bottom mb-3">
            <label>Create Password</label>
            <input type="password" class="form-control rounded-0 border-0 px-0" placeholder="Password">
         </div>
         <div class="form-group border-bottom mb-5">
            <label>Create Password</label>
            <input type="password" class="form-control rounded-0 border-0 px-0" placeholder="Password">
         </div>
         <button class="btn btn-primary">Create Account</button>
      </form> --}}

   </div>
</section>
@endsection