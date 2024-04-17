@extends('layouts.dashboard.main')

@section('title')
S'inscrire
@endsection

@section('content')
<div class="container mt-2 mb-5 min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-1">
                <div class="card-header bg-dark text-light fs-4">{{ __('S\'inscrire') }}</div>

                <div class="card-body">
                    @include('layouts.dashboard.form_register')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
