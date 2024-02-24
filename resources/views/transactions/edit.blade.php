@extends('layout.app')

@section('title', __('Edit Transaction'))
@section('description', __('Edit an existing transaction'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Transaction') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @include('transactions.partials._form')
                        <button type="submit" class="btn btn-primary">{{ __('Update Transaction') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
