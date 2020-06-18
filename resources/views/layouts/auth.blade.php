<html lang="{{ app()->getLocale() }}">


    @include('partials.auth.head')
    @stack('head_css_start')
    @stack('head_css_end')
    <style>
        body{
            all: none;
            margin: 0;
            margin-top: -50px;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            font-family: Averta;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #303C54;
            background: #ecf0f3;

        }
        .login-div{
            width: 320px;
            height: 477px;
            padding: 30px 35px 35px 35px;
            border-radius: 40px;
            background: #ecf0f3;
            box-shadow: 13px 13px 20px #cbced1,
            -13px -13px 20px #ffffff;
        }
        .logo{
            background: #303C54;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow:
                /* logo shadow */
                    0px 0px 2px #5f55f5,
                        /* offset */
                    0px 0px 0px 5px #ecf0f3,
                        /* bottom-right */
                    8px 8px 15px #a7aaaf,
                        /* top-left */
                    -8px -8px 15px #ffffff;

        }
        .title{
            text-align: center;
            font-size: 24px;
            padding-top: 24px;
            letter-spacing: 0.5px;
            font-family: Averta-Bold;
        }
        .sub-title{
            text-align: center;
            font-size: 14px;
            padding-top: 7px;
            letter-spacing: 1px;
            padding-bottom: 10px;
        }
        .fields{
            width: 100%;
            padding: 30px 4px 5px 4px;
        }
        .user-input, .pass-input{
            margin-bottom: 40px;
            border-radius: 40px;
            box-shadow: inset 8px 8px 8px #cbced1,
            inset -8px -8px 8px #ffffff;

        }
        .form-control{
            all: none;
            border: none;
            outline: none;
            background: none;
            font-size: 18px;
            color: #303C54;
            padding: 16px 8px 16px 4px;
            width: 70%;

        }
        .input-group:focus-within
        {
            box-shadow: inset 8px 8px 8px #cbced1,
            inset -8px -8px 8px #ffffff !important;

        }


        .input-group-text{
            all: none;
            border: none;
            outline: none;
            background: none;
        }

        .icon-customize{
            margin: 0px 8px -3px 15px;
            font-size: 20px !important;
            color: #303C54;
        }
        .signin-button{
            outline: none;
            border: none;
            cursor: pointer;
            width: 100%;
            height: 50px;
            border-radius: 30px;
            font-size: 20px;
            font-family: Averta-Bold;
            color: #fff;
            text-align: center;
            background: #303C54;
            box-shadow: 3px 3px 3px #b1b1b1,
            -3px -3px 3px #fff;
            transition: 0.5s;
        }
        .signin-button:hover{
            background: #475675;
        }
        .signin-button:active{
            background: #303C54;
        }
        .link{
            padding-top: 20px;
            text-align: center;
        }
        .link a{
            text-decoration: none;
            color: #303C54;
            font-size: 15px;
        }
        .font{
            font-size: 60px;
            color: #fff;
            margin-top: 20px;
        }
        .rememberMe{
            color: #303C54;
            font-size: 15px;
        }
        .allignCenter{
            text-align: center;
            padding-bottom: 10px;
        }
        .danger{
            color:red;
            font-size: 13px;
            position: fixed;
        }
        @media only screen and (min-width: 1900px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -44%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 1900px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -43%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 1650px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -42%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 1450px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -41%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 1200px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -39%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 1050px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -38%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 800px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -34%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 750px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -32%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 600px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -29%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 550px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -27%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 500px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -25%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 460px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -23%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 440px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -20%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 400px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -18%;
                position: fixed;
            }
        }
        @media only screen and (max-width: 350px)  {
            .invalid-feedback{
                margin-top: -30px;
                margin-left: -11%;
                position: fixed;
            }
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active  {
            -webkit-box-shadow: inset 0px 8px 8px #cbced1,
            inset 0px -8px 8px #ffffff!important;
            /*border-radius: 40px !important;*/
            border-top-right-radius: 40px !important;
            border-bottom-right-radius: 40px !important;
        }
    </style>
{{--    class="login-page"--}}
    <body>
        @stack('body_start')

{{--        <div class="main-content mt-4">--}}
{{--            <div class="header">--}}
{{--                <div class="container">--}}
{{--                    <div class="header-body text-center">--}}
{{--                        <div class="row justify-content-center">--}}
{{--                            <div class="col-xl-5 col-lg-6 col-md-8">--}}
{{--                                <img class="mb-5" src="{{ asset('public/img/akaunting-logo-white.svg') }}" width="22%" alt="Akaunting"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            @stack('login_box_start')
{{--                <div class="container">--}}
{{--                    <div class="row justify-content-center">--}}
{{--                        <div class="col-lg-5 col-md-7">--}}
{{--                            <div class="card mb-0 login-card-bg">--}}
{{--                                <div class="card-body px-lg-5 py-lg-5">--}}
{{--                                    <div class="text-center text-white mb-4">--}}
{{--                                        <small>@yield('message')</small>--}}
{{--                                    </div>--}}

                                    <div id="app">
                                        @stack('login_content_start')

                                        @yield('content')

                                        @stack('login_content_end')
                                        <notifications></notifications>
                                    </div>
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @stack('login_box_end')

            @yield('forgotten-password')

{{--            <footer>--}}
{{--                <div class="container mt-5 mb-4">--}}
{{--                    <div class="row align-items-center justify-content-xl-between">--}}
{{--                        <div class="col-xl-12">--}}
{{--                            <div class="copyright text-center text-white">--}}
{{--                                <small>--}}
{{--                                    {{ trans('footer.powered') }}: <a href="{{ trans('footer.link') }}" target="_blank" class="text-white">{{ trans('footer.software') }}</a>--}}
{{--                                </small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </footer>--}}

{{--        </div>--}}

        @stack('body_end')

        @include('partials.auth.scripts')
    </body>

</html>
