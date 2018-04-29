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


@stop

@section('contents')
<div class="row">
    <div class="col-xs-12">

               @include('layouts._work_and_tutorial_panel')

    </div>
</div>
@stop

@section('script')
    <script>
        rh = get_reduce_size(59);
    </script>
@stop