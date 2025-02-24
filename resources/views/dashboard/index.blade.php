@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Minible @endslot
    @slot('title') Dashboard @endslot
@endcomponent 

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: rgb(255, 47, 102)"> 
        <a href="{{ url('admin/product') }}"><div>
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                    <p class="text-muted mb-0">Product</p>
                </div> 
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i></span> Lorem Ipsum
                </p>
            </div>
        </a>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: rgb(255, 196, 47)"> 
        <a href="{{ url('admin/subcategory') }}"><div>
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                    <p class="text-muted mb-0">Sub Category</p>
                </div> 
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i></span> Lorem Ipsum
                </p>
            </div>
        </a>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: rgb(47, 255, 68)"> 
        <a href="{{ url('admin/category') }}"><div>
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                    <p class="text-muted mb-0">Category</p>
                </div> 
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i></span> Lorem Ipsum
                </p>
            </div>
        </a>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: rgb(47, 255, 210)"> 
        <a href="{{ url('admin/brand') }}"><div>
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                    <p class="text-muted mb-0">Brand</p>
                </div> 
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i></span> Lorem Ipsum
                </p>
            </div>
        </a>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-12">
        <div class="card" style="background-color: rgb(221, 221, 221)"> 
        <a href="{{ url('admin/order') }}"><div>
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                    <p class="text-muted mb-0">Order</p>
                </div> 
                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i></span> Lorem Ipsum
                </p>
            </div>
        </a>
        </div>
    </div> <!-- end col-->


</div> <!-- end row-->

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                {{-- <div class="float-end">
                    <div class="dropdown">
                        <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                            <a class="dropdown-item" href="#">Monthly</a>
                            <a class="dropdown-item" href="#">Yearly</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="card-title mb-4">Sales Analytics</h4>
  
                <div class="mt-1">
                    <ul class="list-inline main-chart mb-0">
                        <li class="list-inline-item chart-border-left me-0 border-0">
                            <h3 class="text-primary">$<span data-plugin="counterup"></span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                        </li>
                        {{-- <li class="list-inline-item chart-border-left me-0">
                            <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span>
                            </h3>
                        </li> --}}
                        {{-- <li class="list-inline-item chart-border-left me-0">
                            <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                        </li> --}}
                    </ul>
                </div>

                <div class="mt-3">
                    <div style="height:25%; id="app">
            
        </div>
                    {{-- <div id="sales-analytics-chart" class="apex-charts" dir="ltr"></div> --}}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-xl-4">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <p class="text-white font-size-18">Decision Support Systems <i class="mdi mdi-arrow-right"></i></p>
                        <div class="mt-4">
                            <a href="javascript: void(0);" class="btn btn-success waves-effect waves-light">Analyse Sales</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mt-4 mt-sm-0">
                            <img src="{{ URL::asset('/assets/images/setup-analytics-amico.svg') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->

        <div class="card">
            <div class="card-body">
               

                <h4 class="card-title mb-4">Top Selling Products</h4>


              


               

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end Col -->
</div> <!-- end row-->


@endsection
@section('script')
       <!-- apexcharts -->
       <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

       <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
   

@endsection