@extends("layouts.default")
@section("title","home")

    @section('avatar', $user->avatar)

            @section("functions")
                <div class="row icon-row" style="padding-top:50px">
                    <div class="col-xs-10 col-xs-offset-1 background-block black-background-selected">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>主&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</p>
                            </div>
                        </div>
                    </div>
                </div>
                @can('update', $user)
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-password-toggle">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>修改密码</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row icon-row">
                    <a href="{{ route('users.edit', $user) }}">
                        <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-info">
                            <div class="center-block">
                                <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                <div class="icon-text-list">
                                    <p>用户资料</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="row icon-row">
                    <div class="col-xs-10 col-xs-offset-1 background-block" id="check-firewood-toggle">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>查看余额</p>
                                <input type="text" value="{{ $user->firewood_count }}" hidden id="firewood_count">
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
            @endsection

@section('info')
    @include('users._info')
@endsection

                @section('contents')

                <div class="row" id="carousel-row">
                    <div class="col-xs-12">

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

                @include('layouts._articles-panel', ['articles' => $user->articles()->recent()->paginate(20)])
                @include('shared._errors')
                @include('shared._message')
@endsection

@include('modals.edit-password')


@section("style")
    <style>
        .navbar {
            background-color: #FAFBFC;
        }

    </style>
@stop

