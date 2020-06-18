@extends('layouts.auth')

@section('title', trans('auth.login'))

@section('message', trans('auth.login_to'))

@section('content')

    <center>
        <div class="login-div">
            <div class="logo"><i class="fas fa-user font"></i></div>
            <div class="title"> Login Form </div>
            <div class="sub-title"> Powered By CloudCloder Limited </div>

            {!! Form::open([
                'route' => 'login',
                'id' => 'login',
                '@submit.prevent' => 'onSubmit',
                '@keydown' => 'form.errors.clear($event.target.name)',
                'files' => true,
                'role' => 'form',
                'novalidate' => true
            ]) !!}
            <div role="alert" id="error" class="danger" :class="(form.response.error) ? 'show' : ''" v-if="form.response.error" v-html="form.response.message"></div>
            <div class="fields">
                <div class="email">
{{--                    <i class="fas fa-envelope icon-customize"></i>--}}
                    {{--                    <input type="email" class="user-input" placeholder="Email" >--}}
                    {{ Form::emailGroup('email', false, 'envelope icon-customize', ['placeholder' => trans('general.email')], null, 'has-feedback', 'user-input', 'required') }}
                </div>
                <div class="password">
{{--                    <i class="fas fa-unlock-alt icon-customize"></i>--}}
                    {{--                    <input type="password" class="pass-input" placeholder="Password">--}}
                    {{ Form::passwordGroup('password', false, 'unlock-alt icon-customize', ['placeholder' => trans('auth.password.current')], 'has-feedback', 'pass-input', 'required') }}

                </div>
                {{--                <button class="signin-button">Login</button>--}}
                {!! Form::button(
               '<div class=""></div> <span>' . trans('auth.login') . '</span>',
               [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'signin-button', 'data-loading-text' => trans('general.loading')]) !!}
                <div class="link">
                                @stack('remember_input_start')
                                    <div class="allignCenter">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            {{ Form::checkbox('remember', 1, null, [
                                                'id' => 'checkbox-remember',
                                                'class' => 'custom-control-input',
                                                'v-model' => 'form.remember'
                                            ]) }}
                                            <label class="custom-control-label" for="checkbox-remember">
                                                <span class="rememberMe">{{ trans('auth.remember_me') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @stack('remember_input_end')


                    <a href="{{ route('forgot') }}"> Forgot Password </a>


                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </center>
{{--    <div role="alert" class="alert alert-danger d-none" :class="(form.response.error) ? 'show' : ''" v-if="form.response.error" v-html="form.response.message"></div>--}}

{{--    {!! Form::open([--}}
{{--        'route' => 'login',--}}
{{--        'id' => 'login',--}}
{{--        '@submit.prevent' => 'onSubmit',--}}
{{--        '@keydown' => 'form.errors.clear($event.target.name)',--}}
{{--        'files' => true,--}}
{{--        'role' => 'form',--}}
{{--        'class' => 'form-loading-button',--}}
{{--        'novalidate' => true--}}
{{--    ]) !!}--}}

{{--        {{ Form::emailGroup('email', false, 'envelope', ['placeholder' => trans('general.email')], null, 'has-feedback', 'input-group-alternative') }}--}}

{{--        {{ Form::passwordGroup('password', false, 'unlock-alt', ['placeholder' => trans('auth.password.current')], 'has-feedback', 'input-group-alternative') }}--}}

{{--        <div class="row align-items-center">--}}
{{--            @stack('remember_input_start')--}}
{{--                <div class="col-xs-12 col-sm-8">--}}
{{--                    <div class="custom-control custom-control-alternative custom-checkbox">--}}
{{--                        {{ Form::checkbox('remember', 1, null, [--}}
{{--                            'id' => 'checkbox-remember',--}}
{{--                            'class' => 'custom-control-input',--}}
{{--                            'v-model' => 'form.remember'--}}
{{--                        ]) }}--}}
{{--                        <label class="custom-control-label" for="checkbox-remember">--}}
{{--                            <span class="text-white">{{ trans('auth.remember_me') }}</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @stack('remember_input_end')--}}

{{--            <div class="col-xs-12 col-sm-4">--}}
{{--                {!! Form::button(--}}
{{--                '<div class="aka-loader"></div> <span>' . trans('auth.login') . '</span>',--}}
{{--                [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'btn btn-success float-right header-button-top', 'data-loading-text' => trans('general.loading')]) !!}--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @stack('forgotten-password-start')--}}
{{--            <div class="mt-5 mb--4">--}}
{{--                <a href="{{ route('forgot') }}" class="text-white"><small>{{ trans('auth.forgot_password') }}</small></a>--}}
{{--            </div>--}}
{{--        @stack('forgotten-password-end')--}}
{{--    {!! Form::close() !!}--}}
@endsection

@push('scripts_start')
    <script src="{{ asset('public/js/auth/login.js?v=' . version('short')) }}"></script>
@endpush
{{--        <!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Login</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('public/vendor/averta/css/averta.css') }}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{ asset('public/vendor/fontawesome/css/all.min.css?v=' . version('short')) }}" type="text/css">--}}
{{--    <style>--}}
{{--        body{--}}
{{--            margin: 0;--}}
{{--            margin-top: -10px;--}}
{{--            height: 100vh;--}}
{{--            width: 100vw;--}}
{{--            overflow: hidden;--}}
{{--            font-family: Averta;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            color: #303C54;--}}
{{--            background: #ecf0f3;--}}

{{--        }--}}
{{--        .login-div{--}}
{{--            width: 280px;--}}
{{--            height: 430px;--}}
{{--            padding: 40px 35px 35px 35px;--}}
{{--            border-radius: 40px;--}}
{{--            background: #ecf0f3;--}}
{{--            box-shadow: 13px 13px 20px #cbced1,--}}
{{--            -13px -13px 20px #ffffff;--}}
{{--        }--}}
{{--        .logo{--}}
{{--            background: #303C54;--}}
{{--            width: 100px;--}}
{{--            height: 100px;--}}
{{--            border-radius: 50%;--}}
{{--            margin: 0 auto;--}}
{{--            box-shadow:--}}
{{--                 /* logo shadow */--}}
{{--            0px 0px 2px #5f55f5,--}}
{{--                /* offset */--}}
{{--            0px 0px 0px 5px #ecf0f3,--}}
{{--                /* bottom-right */--}}
{{--            8px 8px 15px #a7aaaf,--}}
{{--                /* top-left */--}}
{{--            -8px -8px 15px #ffffff;--}}

{{--        }--}}
{{--        .title{--}}
{{--            text-align: center;--}}
{{--            font-size: 28px;--}}
{{--            padding-top: 24px;--}}
{{--            letter-spacing: 0.5px;--}}
{{--            font-family: Averta-Bold;--}}
{{--        }--}}
{{--        .sub-title{--}}
{{--            text-align: center;--}}
{{--            font-size: 15px;--}}
{{--            padding-top: 7px;--}}
{{--            letter-spacing: 2px;--}}
{{--        }--}}
{{--        .fields{--}}
{{--            width: 100%;--}}
{{--            padding: 30px 4px 5px 4px;--}}
{{--        }--}}
{{--        .fields input{--}}
{{--            border: none;--}}
{{--            outline: none;--}}
{{--            background: none;--}}
{{--            font-size: 18px;--}}
{{--            color: #303C54;--}}
{{--            padding: 20px 8px 20px 4px;--}}
{{--            width: 70%;--}}
{{--        }--}}
{{--        .email, .password{--}}
{{--            margin-bottom: 30px;--}}
{{--            border-radius: 40px;--}}
{{--            box-shadow: inset 8px 8px 8px #cbced1,--}}
{{--            inset -8px -8px 8px #ffffff;--}}

{{--        }--}}
{{--        .icon-customize{--}}
{{--            margin: 0px 8px -3px 15px;--}}
{{--            font-size: 20px !important;--}}
{{--        }--}}
{{--        .signin-button{--}}
{{--            outline: none;--}}
{{--            border: none;--}}
{{--            cursor: pointer;--}}
{{--            width: 100%;--}}
{{--            height: 60px;--}}
{{--            border-radius: 30px;--}}
{{--            font-size: 20px;--}}
{{--            font-family: Averta-Bold;--}}
{{--            color: #fff;--}}
{{--            text-align: center;--}}
{{--            background: #303C54;--}}
{{--            box-shadow: 3px 3px 3px #b1b1b1,--}}
{{--                       -3px -3px 3px #fff;--}}
{{--            transition: 0.5s;--}}
{{--        }--}}
{{--        .signin-button:hover{--}}
{{--            background: #475675;--}}
{{--        }--}}
{{--        .signin-button:active{--}}
{{--            background: #303C54;--}}
{{--        }--}}
{{--        .link{--}}
{{--            padding-top: 20px;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .link a{--}}
{{--            text-decoration: none;--}}
{{--            color: #303C54;--}}
{{--            font-size: 15px;--}}
{{--        }--}}
{{--        .font{--}}
{{--            font-size: 60px;--}}
{{--            color: #fff;--}}
{{--            margin-top: 20px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<center>--}}
{{--    <div class="login-div">--}}
{{--        <div class="logo"><i class="fas fa-user font"></i></div>--}}
{{--        <div class="title"> Login Form </div>--}}
{{--        <div class="sub-title"> Powered By CloudCloder Limited </div>--}}
{{--        {!! Form::open(['route' => 'login']) !!}--}}
{{--        <div class="fields">--}}
{{--            <div class="email">--}}
{{--                <i class="fas fa-envelope icon-customize"></i>--}}
{{--                <input type="email" class="user-input" placeholder="Email" >--}}
{{--                {{ Form::text('email', '', array('placeholder'=>'Email')) }}--}}
{{--            </div>--}}
{{--            <div class="password">--}}
{{--                <i class="fas fa-unlock-alt icon-customize"></i>--}}
{{--                <input type="password" class="pass-input" placeholder="Password">--}}
{{--                {{  Form::password('password', ['class' => 'pass-input','placeholder' => 'Password']) }}--}}

{{--            </div>--}}
{{--            <button class="signin-button">Login</button>--}}
{{--            {{ Form::button('Login', ['type' => 'submit', 'class' => 'signin-button'] )  }}--}}
{{--            <div class="link">--}}
{{--                <a href="#"> Forgot Password </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        {!! Form::close() !!}--}}

{{--    </div>--}}
{{--</center>--}}

{{--</body>--}}
{{--</html>--}}