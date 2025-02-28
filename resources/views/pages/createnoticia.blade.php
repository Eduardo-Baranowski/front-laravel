@extends('layouts.app', ['page' => __('Createnoticia'), 'pageSlug' => 'createnoticia'])

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create Notícia') }}</h5>
                </div>
                <form method="post" action="{{ route('noticia.store') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label>{{ __('Título') }}</label>
                                <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Título') }}" value="{{ old('title') }}">
                                 @include('alerts.feedback', ['field' => 'title'])
                            </div>

                            <div class="form-group{{ $errors->has('content_text') ? ' has-danger' : '' }}">
                                <label>{{ __('Conteúdo') }}</label>
                                <textarea type="text" name="content_text" class="form-control{{ $errors->has('content_text') ? ' is-invalid' : '' }}" placeholder="{{ __('Conteúdo') }}" value="{{ old('content_text') }}"></textarea>
                                @include('alerts.feedback', ['field' => 'content_text'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
