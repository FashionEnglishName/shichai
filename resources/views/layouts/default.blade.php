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
        toastr.options.timeOut = 3000;
        toastr.options.closeButton = true;

        function get_reduce_size(height){
            height = arguments[0] ? arguments[0] : 137;
            return height;
        }
    </script>
    @yield('script')
    <script>
        if(rh === undefined){
            var rh = get_reduce_size();
        }
        h = window.innerHeight - rh;
        $('.page-background').css("min-height", h);
        $(window).on("load resize", function(){
            h = window.innerHeight - rh;
            $('.page-background').css("min-height", h);
        });
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
                            <a href="@yield('user_link', route('users.show', Auth::user()))">
                                <img class="center-block img-responsive" src="@yield('avatar', isset(Auth::user()->avatar) ? Auth::user()->avatar : '/profile/login.jpg' )" alt="profile" id="profile">
                            </a>
                        </div>
                    </div>

                    <!--            用户名行            -->
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <a href="@yield('user_link', route('users.show', Auth::user()))">
                                <p class="text-center" id="username"> @yield('name', Auth::user()->name)</p>
                            </a>
                            <p class="text-center" id="publish-date">@yield('date', '')</p>
                        </div>
                    </div>
            @else
                <!--            头像行            -->
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2" id="login-img">
                            <a href="{{ route('users.show', isset($user) ? $user->id : Auth::id()) }}" style="color: #5B5B5B;text-decoration: none">
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
                                    <li class="@yield('category',' ')"><a href="{{ route('category', 1) }}">分类</a></li>
                                    {{--<li class="@yield('search',' ')"><a href="#">搜索</a></li>--}}
                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                    @if(Auth::check())
                                        <li>
                                            <a href="{{ route('notifications.index') }}">
                                                <span class="icon-list center-block badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }}" title="消息" style="margin-top: 6px">
                                                    {{ Auth::user()->notification_count }}
                                                </span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            {{--<a href="{{ route('articles.create') }}">--}}
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="margin-right: 0">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                            </a>
                                            <ul class="dropdown-menu header-dropdown-menu">
                                                <li>
                                                    <a href="{{ route('articles.create') }}">
                                                        <p class="text-center">
                                                            <span class="glyphicon glyphicon-book"></span>发布作品
                                                        </p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('tutorials.index') }}">
                                                        <p class="text-center">
                                                            <span class="glyphicon glyphicon-education"></span>创作教程
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <li class="dropdown" id="setting-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="margin-right: 0">
                                            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu header-dropdown-menu">
                                            @if(Auth::user()->can('manage_contents'))
                                                <li>
                                                    <a href="{{ url(config('administrator.uri')) }}">
                                                        <p class="text-center">
                                                            <span class="glyphicon glyphicon-tower"></span>管理后台
                                                        </p>
                                                    </a>
                                                </li>
                                            @endif
                                                <li>
                                                    <form action="{{ route('users.add_firewood', Auth::user()) }}" method="post" id="add-firewood-form" hidden>
                                                        {{ csrf_field() }}
                                                        {{--<button type="submit" class="btn btn-info btn-block" id="btn-add-firewood">购买柴火</button>--}}
                                                    </form>
                                                    <a id="add-firewood-form-button">
                                                        <p class="text-center">
                                                            <span class="glyphicon glyphicon-shopping-cart"></span>购买柴火
                                                        </p>
                                                    </a>
                                                </li>
                                                <input type="text" hidden value="{{ Auth::user()->id }}" id="user-id-for-firewood">

                                                {{--<li role="separator" class="divider"></li>--}}
                                                <li>
                                                    <form method="post" action="{{ route('logout') }}" id="logout-form" hidden>
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                        {{--<button type="submit" class="btn btn-danger btn-block" id="btn-logout">退出</button>--}}
                                                    </form>
                                                    <a id="logout-form-button">
                                                        <p class="text-center">
                                                            <span class="glyphicon glyphicon-log-out"></span>退出登录
                                                        </p>
                                                    </a>
                                                </li>
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
@include('shared._message')
@guest
    @include("modals.signup-modal")
    @include("modals.login-modal")
@endguest
</body>
</html>
