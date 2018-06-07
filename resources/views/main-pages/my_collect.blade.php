@extends('layouts.default')
@section('title','我的收藏')


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
            <div class="col-xs-10 col-xs-offset-1 background-block black-background-selected">
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
@stop

@section('contents')


    <!--            二级导航栏            -->
    <div class="row">
        <div class="col-xs-12" id="second-navbar-row">
            <div class="navbar navbar-default" id="second-navbar" role="navigation">
                <div class="container">
                    <ul class="nav navbar-nav" id="second-navbar-text">
                        <li @if($article_type === 'tutorial' || !isset($article_type))class="li-active" @endif><a href="{{ Request::url()}}?type=tutorial">教程</a></li>
                        <li @if($article_type === 'work') class="li-active" @endif><a href="{{ Request::url() }}?type=work">作品</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if($articles->count())
        @include('layouts._articles-panel', ['articles' => $articles])
    @else
        <div class="row page-background">
            <div class="col-xs-8 col-xs-offset-2">
                <p class="text-center no-articles">藏品空空如也</p>
            </div>
        </div>
    @endif
@stop
