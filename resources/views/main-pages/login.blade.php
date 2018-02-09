@extends("layouts.default")
@section("title","home")

@section("contents")

    <div class="container-fluid">
        <div class="row">
            <div id="left-panel">
                <!--            头像行            -->
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <a href="#" style="color: #5B5B5B;text-decoration: none">
                            <img class="center-block img-responsive" src="/profile/login.jpg" alt="profile" id="profile">
                            <br>
                            <p class="text-center">请先登录</p>
                        </a>
                    </div>
                </div>



                <!--            功能列表            -->
                <div class="row icon-row" style="padding-top:50px">
                    <div class="col-xs-10 col-xs-offset-1 background-block">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>登陆</p>
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

            </div>


            <div class="col-xs-10 col-xs-offset-2" id="changed-col-xs-10">
                <!--            导航栏            -->
                <div class="row">
                    <div class="col-xs-12" id="navbar-row">
                        <!--  navbar start  -->
                        <div class="navbar navbar-default" role="navigation">
                            <div class="container">
                                <ul class="nav navbar-nav" id="navbar-text">
                                    <li class="li-active"><a href="#">首页</a></li>
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

                <!--            轮播             -->
                <div class="row" id="carousel-row">
                    <div class="col-xs-12">
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

                <!--            主要内容             -->
                <div class="row page-background">
                    <div class="col-xs-12">
                        <div class="center-block" style="width: 1000px;">
                            <div class="row">
                                <div class="col-xs-3 thumbnail-col">
                                    <a href="#" class="thumbnail thumbnail-resize">
                                        <img src="/imgs/carousel-1.jpg" alt="first">
                                    </a>
                                </div>
                                <div class="col-xs-3 thumbnail-col">
                                    <a href="#" class="thumbnail">
                                        <img src="/imgs/carousel-2.jpg" alt="second">
                                    </a>
                                </div>
                                <div class="col-xs-3 thumbnail-col">
                                    <a href="#" class="thumbnail">
                                        <img src="/imgs/carousel-1.jpg" alt="third">
                                    </a>
                                </div>
                                <div class="col-xs-3 thumbnail-col">
                                    <a href="#" class="thumbnail">
                                        <img src="/imgs/carousel-1.jpg" alt="fourth">
                                    </a>
                                </div>
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
