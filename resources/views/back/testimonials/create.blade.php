@extends('back/layouts.layout')


@section('content')
<div class="container py-4">
    <h4 class="mb-3">Add Testimonial</h4>
    <form action="{{ route('testimonials.store') }}" method="POST">
        @csrf
        @include('back.testimonials._form', ['testimonial' => null])
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
