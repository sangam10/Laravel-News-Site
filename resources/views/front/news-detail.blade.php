@extends('layouts.front.layout')
@section('styles')
    @vite(['resources/css/media_query.css', 'resources/css/bootstrap.css', 'resources/css/animate.css', 'resources/css/owl.carousel.css', 'resources/css/owl.theme.default.css', 'resources/css/style_1.css', 'resources/js/modernizr-3.5.0.min.js'])
@endsection

@section('content')
    {{-- <div id="fh5co-title-box"
        style="background-image: url({{ asset('storage/images') }}/{{ $news->featured_image_name }}); background-position: 0px -20px"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="page-title">
            <span>{{ $news->updated_at->format('Y/m/d') }}</span>
            <h2>{{ $news->title }}</h2>
        </div>
    </div> --}}
    <div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">

        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                    <div class="page-title">
                        <h2>{{ $news->title }}</h2>
                    </div>
                    <div id="fh5co-title-box">
                        <img src="{{ asset('storage/images') }}/{{ $news->featured_image_name }}" alt="{{ $news->title }}"
                            style="height: 100%;width:100%;object-fit:cover" data-stellar-background-ratio="0.5">
                        {{-- <div class="overlay"></div> --}}
                    </div>
                    {{-- <span>{{ $news->updated_at->format('Y/m/d') }}</span> --}}
                    <hr>
                    {!! $news->description !!}
                </div>
                <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tags</div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="fh5co_tags_all">
                        <a href="#" class="fh5co_tagg">Business</a>
                        <a href="#" class="fh5co_tagg">Technology</a>
                        <a href="#" class="fh5co_tagg">Sport</a>
                        <a href="#" class="fh5co_tagg">Art</a>
                        <a href="#" class="fh5co_tagg">Lifestyle</a>
                        <a href="#" class="fh5co_tagg">Three</a>
                        <a href="#" class="fh5co_tagg">Photography</a>
                        <a href="#" class="fh5co_tagg">Lifestyle</a>
                        <a href="#" class="fh5co_tagg">Art</a>
                        <a href="#" class="fh5co_tagg">Education</a>
                        <a href="#" class="fh5co_tagg">Social</a>
                        <a href="#" class="fh5co_tagg">Three</a>
                    </div>
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="images/download (1).jpg" alt="img" class="fh5co_most_trading" />
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Magna aliqua ut enim ad minim veniam quis nostrud.
                            </div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="images/allef-vinicius-108153.jpg" alt="img" class="fh5co_most_trading" />
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Enim ad minim veniam nostrud xercitation ullamco.
                            </div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="images/download (2).jpg" alt="img" class="fh5co_most_trading" />
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Magna aliqua ut enim ad minim veniam quis nostrud.
                            </div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center"><img src="images/seth-doyle-133175.jpg" alt="img"
                                class="fh5co_most_trading" /></div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Magna aliqua ut enim ad minim veniam quis nostrud.
                            </div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-4 pt-5">
        <div class="container animate-box">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Trending</div>
            </div>
            <div class="owl-carousel owl-theme" id="slider2">
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img"><img src="images/39-324x235.jpg" alt="" /></div>
                        <div>
                            <a href="#" class="d-block fh5co_small_post_heading"><span class="">The top
                                    10 best computer speakers in the market</span></a>
                            <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                        </div>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img"><img src="images/joe-gardner-75333.jpg" alt="" /></div>
                        <div>
                            <a href="#" class="d-block fh5co_small_post_heading"><span class="">The top
                                    10 best computer speakers in the market</span></a>
                            <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                        </div>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img"><img src="images/ryan-moreno-98837.jpg" alt="" /></div>
                        <div>
                            <a href="#" class="d-block fh5co_small_post_heading"><span class="">The top
                                    10 best computer speakers in the market</span></a>
                            <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                        </div>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img"><img src="images/seth-doyle-133175.jpg" alt="" /></div>
                        <div>
                            <a href="#" class="d-block fh5co_small_post_heading"><span class="">The top
                                    10 best computer speakers in the market</span></a>
                            <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
    </script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>
    @vite(['resources/js/main.js', 'resources/js/jquery.waypoints.min.js', 'resources/js/owl.carousel.min.js'])
@endsection
