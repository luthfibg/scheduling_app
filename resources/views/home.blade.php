@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/preloader_style.css') }}">
<div class="container">
    <div class="row justify-content-center px-md-5">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center px-md-5">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>
@endsection
