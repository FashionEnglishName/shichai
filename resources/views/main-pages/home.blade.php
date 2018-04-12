@extends("layouts.default")
@section("title","home")
@section("home","li-active")


    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
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
                        <div class="row icon-row">
                            <a href="{{ route('tutorials.index') }}">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>创作教程</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="row icon-row">
                            <a href="{{ route('notifications.index') }}">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <span class="icon-list center-block badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }}" title="消息" style="margin-top: 4px">
                                            {{ Auth::user()->notification_count }}
                                        </span>
                                        <div class="icon-text-list ">
                                            <p>消息通知</p>
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

                <div class="row" id="carousel-row">
                    <div class="col-xs-12">
                        <!--            轮播             -->
                        <div id="carousel-example-generic" class="carousel slide center-block" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="/imgs/carousel-1.jpg" class="carousel-img" alt="first">
                                </div>
                                <div class="item">
                                    <img src="/imgs/carousel-2.jpg" class="carousel-img" alt="second">
                                </div>
                                <div class="item">
                                    <img src="/imgs/carousel-3.jpg" class="carousel-img" alt="third">
                                </div>

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
                                    <li class="li-active"><a href="#">已出</a></li>
                                    <li><a href="#">未出</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layouts._articles-panel', ['articles'=>$articles])
                @include('shared._message')
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop


@section("style")
    <style>
        .navbar {
            background-color: #FAFBFC;
        }
    </style>
@stop