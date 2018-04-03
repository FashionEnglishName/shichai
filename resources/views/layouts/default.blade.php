<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title","shichai")</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/toastr.css">
    <link rel="stylesheet" href="/css/cropper.css">
    @yield("style")
    <script language="JavaScript" src="/js/app.js"></script>
    <script language="JavaScript" src="/js/toastr.js"></script>
    <script language="JavaScript" src="/js/cropper.js"></script>
    <script>
        toastr.options.positionClass = "toast-top-center";
        toastr.options.timeOut = 5000;
        toastr.options.closeButton = true;
    </script>
    <script>@yield('script')</script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!--            左侧面板             -->
            <div id="left-panel">
            @if(Auth::check())
                <!--            头像行            -->
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <a href="{{ route('users.show', Auth::user()) }}">
                                <img class="center-block img-responsive" src="@yield('avatar', isset(Auth::user()->avatar) ? Auth::user()->avatar : '/profile/login.jpg' )" alt="profile" id="profile">
                            </a>
                        </div>
                    </div>

                    <!--            用户名行            -->
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <a href="#">
                                <p class="text-center" id="username">@yield('name', Auth::user()->name)</p>
                            </a>
                        </div>
                    </div>
            @else
                <!--            头像行            -->
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2" id="login-img">
                            <a href="#" style="color: #5B5B5B;text-decoration: none">
                                <img class="center-block img-responsive" src="/profile/login.jpg" alt="profile" id="profile">
                                <br>
                                <p class="text-center">请先登录</p>
                            </a>
                        </div>
                    </div>
            @endif

            @yield('info')
            <!--            功能列表            -->
                @yield("functions")
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
                                    <li class="@yield('home',' ')"><a href="{{ route('home') }}">首页</a></li>
                                    <li class="@yield('category',' ')"><a href="{{ route('category') }}">分类</a></li>
                                    <li class="@yield('search',' ')"><a href="#">搜索</a></li>
                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                    @if(Auth::check())
                                        <li>
                                            <a href="#">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                            </a>
                                        </li>
                                    @endif
                                    <li class="dropdown" id="setting-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('users.add_firewood', Auth::user()) }}" method="post" id="add-firewood-form">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-info btn-block" id="btn-add-firewood">购买柴火</button>
                                                </form>
                                            </li>
                                            @if(Auth::check())
                                                <input type="text" hidden value="{{ Auth::user()->id }}" id="user-id-for-firewood">

                                                <li role="separator" class="divider"></li>
                                            <li>
                                                <form method="post" action="{{ route('logout') }}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                    <button type="submit" class="btn btn-danger btn-block" id="btn-logout">退出</button>
                                                </form>
                                            </li>
                                            @else
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @yield("contents")

            </div>

        </div>
    </div>
</body>
</html>
