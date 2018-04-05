@extends('layouts.default')
@section('title','分类')


@section('functions')
    @if(Auth::check())
        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <a href="{{ route('categories.cloth') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block">
                    <div class="center-block">
                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>服&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('categories.photography') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block">
                    <div class="center-block">
                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>摄&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;影</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('categories.video') }}">
                <div class="col-xs-10 col-xs-offset-1  background-block">
                    <div class="center-block">
                        <img src="/imgs/history-icon.png" alt="history" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>影视动画</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="">

            </a>
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>三&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;维</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>平&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;面</p>
                    </div>
                </div>
            </div>
        </div>
    @else
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


@section('category','li-active')

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

    @include('layouts._articles-panel')

@stop

@include("modals.signup-modal")
@include("modals.login-modal")

@section("style")
    <style>
        .navbar {
            background-color: #FAFBFC;
        }
    </style>
@stop