@extends("layouts.default")
@section("title","home")

            @section("functions")
                <div class="row icon-row" style="padding-top:50px">
                    <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-password-toggle">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list icon-text-list-four-words">
                                <p>修改密码</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-info">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list icon-text-list-four-words">
                                <p>修改资料</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection

                @section('contents')

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
@endsection

@include('modals.edit-info')
@include('modals.edit-password')

@section("style")
    <style>
        .navbar {
            background-color: #FAFBFC;
        }

        .icon-text-list{
            letter-spacing: 0.8em;
        }
    </style>
@stop