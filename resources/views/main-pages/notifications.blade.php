@extends('layouts.default')
@section('title','分类')


@section("functions")
    <div class="row icon-row" style="padding-top:50px">
        <a href="{{ route('follow') }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>我的关注</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row icon-row">
        <a href="{{ route('collect') }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>我的收藏</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row icon-row">
        <a href="{{ route('my_purchased') }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>已购项目</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row icon-row">
        <a href="{{ route('tutorials.index') }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>创作教程</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

@stop

@section('contents')
<div class="row page-background">
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
</div>
@stop
