@extends('layouts.default')
@section('title','分类')


@section("functions")

    <div class="row icon-row" style="padding-top:50px">
            <div class="col-xs-10 col-xs-offset-1 background-block black-background-selected">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>动　　态</p>
                    </div>
                </div>
            </div>
    </div>
    <div class="row icon-row">
        <a href="{{ route('followings.list') }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>关注列表</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row icon-row">
        <div class="col-xs-10 col-xs-offset-1 background-block">
            <a href="{{ route('home') }}">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>返　　回</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

@stop

@section('contents')


    <!--            二级导航栏            -->
    <div class="row">
        <div class="col-xs-12" id="second-navbar-row">
            <div class="navbar navbar-default" id="second-navbar" role="navigation">
                <div class="container">
                    <ul class="nav navbar-nav" id="second-navbar-text">
                        <li @if($order === 'default' || !isset($order))class="li-active" @endif><a href="{{ Request::url() }}?order=default">最热</a></li>
                        <li @if($order === 'recent')class="li-active" @endif><a href="{{ Request::url()  }}?order=recent">最新</a></li>
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
                <p class="no-articles text-center">请先关注用户</p>
            </div>
        </div>
    @endif
@stop

