{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Akun
@endsection
@section('content')
<main class="wrapper">
    <section>
        <div class="container">
            <ul class="list-group list-group-flush">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-medium fs-3 text-capitalize">
                            Permintaan Penghapusan Akun
                        </h4>
                        <form method="post" action="">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label text-start">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-start">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="reason" class="form-label text-start">Alasan Hapus Akun</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </form>
                    </div>
                </div>
            </ul>
        </div>
    </section>
</main>

@endsection
