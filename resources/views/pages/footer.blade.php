<footer class="footer">
    <div class="footercolor">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <img id="logo" src="{{ asset('images/remote_homework_logo.png') }}" alt="Logo" style="width:130px;">

                    <p class="pt-4 footertext">An easy and simple online platform to
                        remotely collaborate and give feedback on (home)work.
                    </p>

                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <p class=" footertext footerlink pl-4" href="#">{{ __('Navigation') }}</p>

                    <ul>
                        <li style="list-style-type: none;" class="footertext">{{ __('Home') }}</li>
                        <li style="list-style-type: none;" class="footertext">{{ __('Info') }}</li>
                        <li style="list-style-type: none;" class="footertext">{{ __('What we offer') }}</li>
                        <li style="list-style-type: none;" class="footertext">{{ __('How it works') }}</li>
                        <li style="list-style-type: none;" class="footertext">{{ __('Tutorials') }}</li>
                    </ul>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <p class="footertext footerlink pl-4" href="#">{{ __('Social Media') }}</p>

                    <ul>
                        <li style="list-style-type: none;" class="footertext">Facebook</li>
                        <li style="list-style-type: none;" class="footertext">Instagram</li>
                        <li style="list-style-type: none;" class="footertext">Twitter</li>
                        <li style="list-style-type: none;" class="footertext">Reddit</li>
                        <li style="list-style-type: none;" class="footertext">Youtube</li>
                    </ul>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <p class="footertext footerlink pl-4">{{ __('Contact') }}</p>

                    <ul>
                        <li style="list-style-type: none;" class="footertext">+31 612345678</li>
                        <li style="list-style-type: none;" class="footertext">Dorpsstraat 1a</li>
                        <li style="list-style-type: none;" class="footertext">1234AB</li>
                        <li style="list-style-type: none;" class="footertext">Ons Dorp</li>
                        <li style="list-style-type: none;" class="footertext">info@example.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footerdark">
        <div class="container">
            <div class="text-center pt-3 pb-3">
                <p class="my-auto footertext">{{ __('Copyright :year :name', ['year' => Carbon\Carbon::now()->format('Y'), 'name' => config('app.name', 'Remote Homework')]) }}</p>
            </div>
        </div>
    </div>
</footer>
