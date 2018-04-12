@extends('layouts.default')
@section('title','分类')


@section("functions")
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
@stop

@section('contents')


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

    @if($articles->count())
        @include('layouts._articles-panel', ['articles' => $articles])
    @else
        您还没有点燃柴火堆
    @endif

@stop


@section("style")
    <style>
        .navbar {
            background-color: #FAFBFC;
        }
    </style>
@stop