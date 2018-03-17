<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title","shichai")</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/toastr.css">
    @yield("style")
    <script language="JavaScript" src="/js/app.js"></script>
    <script language="JavaScript" src="/js/toastr.js"></script>
    <script>
        toastr.options.positionClass = "toast-top-center";
        toastr.options.timeOut = 5000;
        toastr.options.closeButton = true;
    </script>

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
                            <a href="{{ route('users.show', 'id') }}">
                                <img class="center-block img-responsive" src="/profile/u=1611505379,380489200&fm=27&gp=0.jpg" alt="profile" id="profile">
                            </a>
                        </div>
                    </div>

                    <!--            用户名行            -->
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <a href="#">
                                <p class="text-center" id="username">{{ Auth::user()->name }}</p>
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
                                    <li class="dropdown" id="setting-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <img src="/imgs/setting-icon.png" alt="setting" id="setting-icon"><span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            @if(Auth::check())
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
