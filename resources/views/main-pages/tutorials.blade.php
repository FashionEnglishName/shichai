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

                @if ($assigned_works->count())

                    <div class="assigned-work-list">
                        @foreach ($assigned_works as $assigned_work)
                            @include('layouts._assigned_work')
                        @endforeach

                        {!! $assigned_works->render() !!}
                    </div>

                @else
                    <p class="text-center no-articles">还没有柴火堆被你点燃</p>
                @endif

    </div>
</div>
@stop