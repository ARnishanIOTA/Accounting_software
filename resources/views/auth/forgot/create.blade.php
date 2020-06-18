@extends('layouts.auth')

@section('title', trans('auth.reset_password'))

@section('message', trans('auth.reset_password'))
@stack('head_css_start')
<style>

        .invalid-feedback {
            margin-top: -30px;
            margin-left: 55px !important;
            position: fixed;
        }

</style>
@stack('head_css_end')

@section('content')


    <div role="alert" class="alert alert-success d-none" :class="(form.response.success) ? 'show' : ''" v-if="form.response.success" v-html="form.response.message"></div>
    <div role="alert" class="alert alert-danger d-none" :class="(form.response.error) ? 'show' : ''" v-if="form.response.error" v-html="form.response.message"></div>

    {!! Form::open([
        'route' => 'forgot',
        'id' => 'forgot',
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true
    ]) !!}
      <div class="fields">
          <div class="email">

        @stack('email_input_start')
            {{ Form::emailGroup('email', false, 'envelope icon-customize', ['placeholder' => trans('general.email')], null, 'has-feedback', 'pass-input') }}
        @stack('email_input_end')

          </div>
      </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                {!! Form::button(
                '<div class=""></div> <span>' . trans('general.send') . '</span>',
                [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'signin-button', 'data-loading-text' => trans('general.loading')]) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@push('scripts_start')
    <script src="{{ asset('public/js/auth/forgot.js?v=' . version('short')) }}"></script>
@endpush
