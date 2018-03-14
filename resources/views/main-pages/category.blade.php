@extends('layouts.default')
@section('title','分类')


            @section('functions')
                <!--            功能列表            -->
                <div class="row icon-row" style="padding-top:50px">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>平面</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>插画</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>摄影</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1  background-block">
                        <div class="center-block">
                            <img src="/imgs/history-icon.png" alt="history" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>影视</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>三维</p>
                            </div>
                        </div>
                    </div>
                </div>
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

                <!--            主要内容             -->
                <div class="row page-background">
                    <div class="col-xs-12">
                        <div class="center-block" style="width: 1000px;">
                            <div class="card-list">
                                <div class="card">
                                    <a href="#">
                                        <img src="/imgs/carousel-1.jpg" alt="first">
                                    </a>
                                    <div class="card-info">
                                        <a href="#">
                                            <h4 class="card-info-title">
                                                给你点颜色看看<br/>
                                                <small><a href="#">平面</a></small>
                                            </h4>
                                        </a>
                                        <p class="text-right lead">已购&nbsp;&nbsp;<span class="card-info-sales">222</span></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#">
                                        <img src="/imgs/carousel-2.jpg" alt="second">
                                    </a>
                                    <div class="card-info">
                                        <h4 class="card-info-title">
                                            给你点颜色看看<br/>
                                            <small>平面</small>
                                        </h4>
                                        <p class="text-right lead">已购&nbsp;&nbsp;<span class="card-info-sales">222</span></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#">
                                        <img src="/imgs/carousel-1.jpg" alt="third">
                                    </a>
                                    <div class="card-info">
                                        <h4 class="card-info-title">
                                            给你点颜色看看<br/>
                                            <small>平面</small>
                                        </h4>
                                        <p class="text-right lead">已购&nbsp;&nbsp;<span class="card-info-sales">222</span></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#">
                                        <img src="/imgs/carousel-1.jpg" alt="fourth">
                                    </a>
                                    <div class="card-info">
                                        <h4 class="card-info-title">
                                            给你点颜色看看<br/>
                                            <small>平面</small>
                                        </h4>
                                        <p class="text-right lead">已购&nbsp;&nbsp;<span class="card-info-sales">222</span></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#">
                                        <img src="/imgs/carousel-1.jpg" alt="fourth">
                                    </a>
                                    <div class="card-info">
                                        <a href="#">
                                            <h4 class="card-info-title">
                                                给你点颜色看看<br/>
                                                <small>平面</small>
                                            </h4>
                                        </a>
                                        <p class="text-right lead">已购&nbsp;&nbsp;<span class="card-info-sales">222</span></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#">
                                        <img src="/imgs/carousel-1.jpg" alt="fourth">
                                    </a>
                                    <div class="card-info">
                                        <h4 class="card-info-title">
                                            给你点颜色看看<br/>
                                            <small>平面</small>
                                        </h4>
                                        <p class="text-right lead">已购&nbsp;&nbsp;<span class="card-info-sales">222</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@stop

@section("style")
    <style>
        .navbar {
            background-color: #FAFBFC;
        }
    </style>
@stop