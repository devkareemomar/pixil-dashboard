@extends('layout.app')

@section('title', __('Create Payment Gateway'))
@section('description', __('Create a new payment gateway'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create page') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('payment-gateways.store') }}" method="POST"
                          enctype="multipart/form-data"
                    >
                        @csrf
                        @include('payment-gateways.partials._form')
                        <button type="submit" class="btn btn-primary">{{ __('Create Payment Gateway') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
