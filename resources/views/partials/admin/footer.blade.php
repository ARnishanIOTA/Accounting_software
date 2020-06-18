@stack('footer_start')
    <footer class="footer">
        <div class="row">
{{--            <div class="col-xs-12 col-sm-6">--}}
{{--                <div class="text-sm float-left text-muted footer-texts">--}}
{{--                    {{ trans('footer.powered') }}: <a href="{{ trans('footer.link') }}" target="_blank" class="text-muted">{{ trans('footer.software') }}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-6">--}}
{{--                <div class="text-sm float-right text-muted footer-texts">--}}
{{--                    {{ trans('footer.version') }} {{ version('short') }}--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-xs-12 col-sm-12">
                <div class="text-white footer-texts text-center">
                    {{ trans('Powered By ') }}: <a href="{{ trans('https://www.cloud-coder.com/') }}" target="_blank" class="text-white">{{ trans('CloudCoder Limited') }}</a>
                </div>
            </div>
        </div>
    </footer>
@stack('footer_end')
