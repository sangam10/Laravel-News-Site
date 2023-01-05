<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <img src="{{ asset('images/logo.png') }}" alt="img" class="fh5co_logo_width" />
            </div>
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table">
                        <div class="fh5co_verticle_middle"><i class="fa fa-search"></i></div>
                    </a>
                </div>
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table">
                        <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                    </a>
                </div>
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table">
                        <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                    </a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://twitter.com/fh5co" target="_blank" class="fh5co_display_table">
                        <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                    </a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://fb.com/fh5co" target="_blank" class="fh5co_display_table">
                        <div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div>
                    </a>
                </div>
                <!--<div class="d-inline-block text-center"><img src="images/country.png" alt="img" class="fh5co_country_width"/></div>-->
                @if (auth()->user())
                    <div class="d-inline-block text-center">
                        <a href="{{ route('admin.dashboard') }}" class="fh5co_display_table">
                            <div class="fh5co_verticle_middle">Dashboard</div>
                        </a>
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" alt="img"
                    class="mobile_logo_width" /></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('news.index') }}">Home<span
                                class="sr-only">(current)</span></a>
                    </li>
                    @foreach ($menu as $item)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news.index') }}">{{ $item->category_name }} <span
                                    class="sr-only">(current)</span></a>
                        </li>
                    @endforeach

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">World <span
                                class="sr-only">(current)</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                            <a class="dropdown-item" href="#">Action in</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
