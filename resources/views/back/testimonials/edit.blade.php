@extends('back/layouts.layout')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Edit Testimonial</h4>
    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST">
        @csrf @method('PUT')
        @include('back.testimonials._form', ['testimonial' => $testimonial])
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
