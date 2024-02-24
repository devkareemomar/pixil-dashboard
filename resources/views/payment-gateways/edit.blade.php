@extends('layout.app')

@section('title', __('Edit Payment Gateway'))
@section('description', __('Edit a new Payment Gateway'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Payment Gateway') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('payment-gateways.update', $paymentGateway->id) }}" method="POST"
                          enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')
                        @include('payment-gateways.partials._form')
                        <button type="submit" class="btn btn-primary">{{ __('Edit Payment Gateway') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
