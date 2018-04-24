@extends('layouts.default')
@section('title','分类')


@section("functions")
    <div class="row icon-row" style="padding-top:50px">
        <a>
            <div class="col-xs-10 col-xs-offset-1 background-block" id="clear-all-notifications-button">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <form action="{{ route('notifications.clear') }}" method="post" id="clear-all-notifications-form">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    <div class="icon-text-list">
                        <p>清空消息</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row icon-row">
        <a href="{{ url()->previous() === route('notifications.index') ? route('home') : url()->previous() }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>{{ url()->previous() === route('notifications.index') ? '返回主页' : '返　　回' }}</p>
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

                @else
                    <div class="empty-block">没有消息通知！</div>
                @endif

            </div>
        </div>
    </div>
</div>
@stop


@section('script')
    <script>
        rh = get_reduce_size(58);
    </script>
@stop
