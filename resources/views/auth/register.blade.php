@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        <div class="col-md-7 mr-auto ml-auto">
            <div class="card card-register card-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">{{ __('Register') }}</h4>
                </div>
                <form class="form" method="post" action="{{ route('user.store') }}">
                    @csrf

                    <div class="card-body">
                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-email-85"></i>
                                </div>
                            </div>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                        </div>
                        <div class="form-check text-left {{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label class="form-check-label">
                                <input class="form-check-input {{ $errors->has('agree_terms_and_conditions') ? ' is-invalid' : '' }}" name="agree_terms_and_conditions"  type="checkbox"  {{ old('agree_terms_and_conditions') ? 'checked' : '' }}>
                                <span class="form-check-sign"></span>
                                {{ __('I agree to the') }}
                                <a href="#">{{ __('terms and conditions') }}</a>.
                                @include('alerts.feedback', ['field' => 'agree_terms_and_conditions'])
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Get Started') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
