<div class="subscribe">
   <p>
      “🚨 Daily Roast Drops – Subscribe Now”
   </p>

   @if (session('success'))
   <div class="alert alert-success small py-2 my-2">
      {{ session('success') }}
   </div>
   @endif

   @if ($errors->any())
   <div class="alert alert-danger small py-2 my-2">
      @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
      @endforeach
   </div>
   @endif

   <div class="form">
      <form action="{{ route('email.subscribe.store') }}" method="POST">
         @csrf
         <div class="input-group">
            <input type="email" name="email"
               class="form-control rounded-0 border-light border-end-0 pe-0"
               placeholder="Your Email" required>
            <button class="btn rounded-0 border-light border-start-0">
               <i class="fas fa-envelope"></i>
            </button>
         </div>
      </form>
   </div>
</div>