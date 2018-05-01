@extends('layouts.default')
@section('title','分类')


@section("functions")

        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <a href="{{ route('tutorials.index') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block {{ $type === 'index' ? 'black-background-selected' : '' }}">
                    <div class="center-block">
                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>全部作品</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('tutorials.finished') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block {{ $type === 'finished' ? 'black-background-selected' : '' }}">
                    <div class="center-block">
                        <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>已经完成</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('tutorials.waiting') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block {{ $type === 'waiting' ? 'black-background-selected' : '' }}">
                    <div class="center-block">
                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>等待创作</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <a href="{{ route('tutorials.unfired') }}">
                <div class="col-xs-10 col-xs-offset-1 background-block {{ $type === 'unfired' ? 'black-background-selected' : '' }}">
                    <div class="center-block">
                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>无人问津</p>
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