@extends("layouts.default")
@section("title","拾柴")
@section("home","li-active")

@section("functions")

    @if(Auth::check())
        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <a href="{{ route('follow') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block">
                    <div class="center-block">
                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>我的关注</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('collect') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block">
                    <div class="center-block">
                        <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>我的收藏</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('my_purchased') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block">
                    <div class="center-block">
                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>已购项目</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    @else
        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <div class="col-xs-10 col-xs-offset-1 background-block" id="login">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;陆</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block" id="signUp">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;册</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section("contents")

    <div class="row" id="carousel-row" style="margin-top: 30px;">
        <div class="col-xs-12">
            <!--            轮播             -->
            <div id="carousel-example-generic" class="carousel slide center-block" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <a href="{{ route('articles.show', isset($first_banner) ? $first_banner->article->id : ' ') }}">
                            <img src="{{ isset($first_banner) ? $first_banner->image : ' ' }}" class="carousel-img" alt="first" width="1000px">
                        </a>
                    </div>
                    @if(isset($first_banner))
                        @foreach($rest_banners as $banner)
                            <div class="item">
                                <a href="{{ route('articles.show', $banner->article->id) }}">
                                    <img src="{{ $banner->image }}" class="carousel-img" alt="{{ $banner->article->title }}" width="1000px">
                                </a>
                            </div>
                    @endforeach
                @endif

                <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--            二级导航栏            -->
    <div class="row">
        <div class="col-xs-12" id="second-navbar-row">
            <div class="navbar navbar-default" id="second-navbar" role="navigation">
                <div class="container">
                    <ul class="nav navbar-nav" id="second-navbar-text">
                        <li @if($order === 'default'||!isset($order))class="li-active" @endif><a href="{{ Request::url() }}?order=default">最热</a></li>
                        <li @if($order === 'recent')class="li-active" @endif><a href="{{ Request::url() }}?order=recent">最新</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._articles-panel', ['articles'=>$articles])

@stop
