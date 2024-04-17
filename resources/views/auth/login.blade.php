@extends('layouts.dashboard.main')

@section('title')
Se connecter
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-5">
                <div class="card-header bg-dark text-light fs-4">{{ __('Se connecter') }}</div>

                <div class="card-body">
                    @include('layouts.dashboard.form_login')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
