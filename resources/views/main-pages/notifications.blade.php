@extends('layouts.default')
@section('title','分类')


@section("functions")

    @if(Auth::check())
        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>我的关注</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>我的收藏</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>已购项目</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block  black-background-selected">
                <div class="center-block">
                    <span class="icon-list center-block badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }}" title="消息" style="margin-top: 4px">
                        {{ Auth::user()->notification_count }}
                    </span>
                    <div class="icon-text-list ">
                        <p>消息通知</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!--            功能列表            -->
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

@section('contents')

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-body">

                <h3 class="text-center">
                    <span class="glyphicon glyphicon-bell" aria-hidden="true"></span> 我的消息
                </h3>
                <hr>

                @if ($notifications->count())

                    <div class="notification-list">
                        @foreach ($notifications as $notification)
                            @include('notifications._' . snake_case(class_basename($notification->type)))
                        @endforeach

                        {!! $notifications->render() !!}
                    </div>
                    <div class="well well-sm">
                        <form action="{{ route('notifications.clear') }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">清空消息记录</button>
                        </form>
                    </div>

                @else
                    <div class="empty-block">没有消息通知！</div>
                @endif

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