@extends('back/layouts.layout')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            {{-- header-start --}}
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Create Transaction Subscribe</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Transaction</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Subscribe</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- header-end --}}

            {{-- body-start --}}
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title"></div>
                        </div>
                        <div class="card-body pt-0">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('subscribe.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label>User</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Plan</label>
                                    <select name="plan" id="plan" class="form-control">
                                        <option value="weekly" data-stripe-id="price_1R26JEG79v7Vucc9WZggw9sV" data-amount="1">Weekly ($1)</option>
                                        <option value="monthly" data-stripe-id="price_1R26TgG79v7Vucc9UShXcRxT" data-amount="10">Monthly ($10)</option>
                                        <option value="yearly" data-stripe-id="price_1R26UDG79v7Vucc9EFhos47z" data-amount="100">Yearly ($100)</option>
                                    </select>
                                </div>

                                <input type="hidden" name="stripe_subscription_id" id="stripe_subscription_id">

                                <div class="mb-3">
                                    <label>Amount ($)</label>
                                    <input type="text" name="amount" id="amount" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="expired">Expired</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- body-end --}}

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const planSelect = document.getElementById("plan");
        const stripeInput = document.getElementById("stripe_subscription_id");
        const amountInput = document.getElementById("amount");

        function updateFields() {
            const selectedOption = planSelect.options[planSelect.selectedIndex];
            stripeInput.value = selectedOption.getAttribute("data-stripe-id");
            amountInput.value = selectedOption.getAttribute("data-amount");
        }

        planSelect.addEventListener("change", updateFields);
        updateFields(); // Set default value on page load
    });
</script>

@endsection
