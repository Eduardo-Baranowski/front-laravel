<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/white-dashboard@1.0.0/css/white-dashboard.css" rel="stylesheet">
        @vite(['resources/css/white-dashboard.css', 'resources/js/app.js'])
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'White Dashboard') }}</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="resources/img/apple-icon.png">
        <link rel="icon" type="image/png" href="resources/img/favicon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('white') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="resources/css/white-dashboard.css?v=1.0.0" rel="stylesheet" />
        <link href="resources/css/theme.css" rel="stylesheet" />
    </head>
    <body class="white-content {{ $class ?? '' }}">

@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/js/app.js'])
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('user.authenticate') }}">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                    <h1 class="card-title text-dark">{{ __('Log in') }}</h1>
                </div>
                <div class="card-body">
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
                    <div class="pull-left">
                        <h6>
                            <a href="{{ route('register') }}" class="link footer-link">{{ __('Create Account') }}</a>
                        </h6>
                    </div>
                    <div class="pull-right">
                        <h6>
                            <a href="{{ route('password.request') }}" class="link footer-link">{{ __('Forgot password?') }}</a>
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
</body>
</html>
