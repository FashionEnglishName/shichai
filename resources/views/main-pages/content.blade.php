@extends("layouts.default")
@section("title","home")

@section("contents")


    <div class="container-fluid">
        <div class="row">
            <div id="left-panel">
                <!--            头像行            -->
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <a href="#">
                            <img class="center-block img-responsive" src="/profile/u=1611505379,380489200&fm=27&gp=0.jpg" alt="profile" id="profile">
                        </a>
                    </div>
                </div>

                <!--            用户名行            -->
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <a href="#">
                            <p class="text-center" id="username">Name</p>
                            <p class="text-center" id="publish-date">发布于8天前</p>
                        </a>
                    </div>
                </div>

                <!--            功能列表            -->
                <div class="row icon-row" style="padding-top:50px">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>关注</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>收藏</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>添柴</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="row icon-row">--}}
                {{--<div class="col-xs-10 col-xs-offset-1  background-block">--}}
                {{--<div class="center-block">--}}
                {{--<img src="/imgs/history-icon.png" alt="history" class="icon-list center-block">--}}
                {{--<div class="icon-text-list">--}}
                {{--<p>历史</p>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>喜爱</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-2" style="width: 255px;"></div>
            <div class="col-xs-10" id="changed-col-xs-10">
                <!--            导航栏            -->
                <div class="row">
                    <div class="col-xs-12" id="navbar-row">
                        <!--  navbar start  -->
                        <div class="navbar navbar-default" role="navigation">
                            <div class="container">
                                <ul class="nav navbar-nav" id="navbar-text">
                                    <li><a href="#">首页</a></li>
                                    <li><a href="#">分类</a></li>
                                    <li><a href="#">搜索</a></li>
                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown" id="setting-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <img src="/imgs/setting-icon.png" alt="setting" id="setting-icon"><span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--            主要内容             -->
                <div class="row">
                    <div class="col-xs-12 content-col">
                        <div class="center-block content">
                            <div class="content-info">
                                <h2>
                                    给你点颜色看看<br/>
                                    <small>平面</small>
                                </h2>
                            </div>
                            <div class="content-main">
                                <img src="/imgs/carousel-1.jpg" alt="">
                            </div>
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