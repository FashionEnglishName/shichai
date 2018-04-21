@extends('layouts.default')
@section('title','分类')


@section("functions")

        <!--            功能列表            -->
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
                <div class="col-xs-10 col-xs-offset-1 background-block black-background-selected">
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
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-body">

                <h3 class="text-center">
                    <span class="glyphicon glyphicon-fire" aria-hidden="true"></span> 点燃的柴火堆
                </h3>
                <hr>

                @if ($assigned_works->count())

                    <div class="assigned-work-list">
                        @foreach ($assigned_works as $assigned_work)
                            @include('layouts._assigned_work')
                        @endforeach

                        {!! $assigned_works->render() !!}
                    </div>

                @else
                    <div class="empty-block no-articles">没有柴火堆被你点燃</div>
                @endif

            </div>
        </div>
    </div>
</div>
@stop