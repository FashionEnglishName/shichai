@extends("layouts.default")
@section("title","home")

@section('avatar', $user->avatar)
@section('name', $user->name)
@section('user_link', route('users.show', $user))

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
                @cannot('update', $user)
                    @if(Auth::user()->isFollowing($user->id))
                        <div class="row icon-row">
                            <div class="col-xs-10 col-xs-offset-1 background-block unfollow">
                                <div class="center-block">
                                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                    <div class="icon-text-list">
                                        <p>取消关注</p>
                                    </div>
                                    <form action="{{ route('followers.destroy', $user->id) }}" method="post" class="unfollow-form">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row icon-row">
                            <div class="col-xs-10 col-xs-offset-1 background-block follow">
                                <div class="center-block">
                                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                    <div class="icon-text-list">
                                        <p>关　　注</p>
                                    </div>
                                    <form action="{{ route('followers.store', $user->id) }}" method="post" class="follow-form">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                @endcannot
            @endsection

@section('info')
    @include('users._info')
@endsection

                @section('contents')

                    <div class="row" style="margin-top: 20px">
                        <div class="xs-12">
                            <div class="center-block" style="width: 1000px;">
                                <div class="row">
                                    <div class="col-xs-3 stat-title"><p class="text-center"><a href="{{ route('users.show_followings', $user->id) }}">关注数</a></p></div>
                                    <div class="col-xs-3 stat-title"><p class="text-center"><a href="{{ route('users.show_followers', $user->id) }}">粉丝数</a></p></div>
                                    <div class="col-xs-3 stat-title"><p class="text-center">作品数</p></div>
                                    <div class="col-xs-3 stat-title"><p class="text-center">教程数</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 stat"><p class="text-center">{{ $user->following_count }}</p></div>
                                    <div class="col-xs-3 stat"><p class="text-center">{{ $user->follower_count }}</p></div>
                                    <div class="col-xs-3 stat"><p class="text-center">{{ $user->work_count }}</p></div>
                                    <div class="col-xs-3 stat"><p class="text-center">{{ $user->tutorial_count }}</p></div>
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
                @include('layouts._articles-panel')
                @include('shared._errors')
                @include('shared._message')
@endsection

@include('modals.edit-password')



