@extends('layouts.default')
@section('title','分类')


@section("functions")

    <div class="row icon-row" style="padding-top:50px">
        <div class="col-xs-10 col-xs-offset-1 background-block">
            <a href="{{ route('follow') }}">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>动　　态</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row icon-row">
        <div class="col-xs-10 col-xs-offset-1 background-block black-background-selected">
            <div class="center-block">
                <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                <div class="icon-text-list">
                    <p>关注列表</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row icon-row">
        <div class="col-xs-10 col-xs-offset-1 background-block">
            <a href="{{ route('home') }}">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>返　　回</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

@stop

@section('contents')

    <div class="row page-background">
        @if($followings->count())
            <div class="col-xs-10 col-xs-offset-1">
                <div class="followings-list-box">
                    @foreach($followings as $following)
                        <div class="followings-list">
                            <div class="row">
                                <div class="col-xs-2">
                                    <img class="avatar avatar-lg" src="{{ $following->avatar }}" alt="{{ $following->name }}">
                                </div>
                                <div class="col-xs-3" style="margin-top: 10px;">
                                    <a href="{{ route('users.show', $following->id) }}" style="font-weight: bold; color: #2c2c2c;">{{ $following->name }}</a>
                                    <p style="color: #bbbbbb;">{{ $following->city->name }} 丨 {{ $following->occupation->name }}</p>
                                    <form action="{{ route('followers.destroy', $following->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">取消关注</button>
                                    </form>
                                </div>
                                <div class="col-xs-3">
                                    <img class="cover" src="{{ $following->articles()->first()->cover }}" alt="{{ $following->articles()->first()->excerpt }}">
                                </div>
                                <div class="col-xs-4">
                                    <img class="cover center-block" src="{{ $following->articles()->skip(1)->take(1)->first()->cover }}" alt="{{ $following->articles()->skip(1)->take(1)->first()->excerpt }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="row page-background">
                <div class="col-xs-8 col-xs-offset-2">
                    <p class="no-articles text-center">请先关注用户</p>
                </div>
            </div>
        @endif
    </div>
@stop

@include('shared._message')

@section('script')
    <script>
        rh = get_reduce_size(58);
    </script>
@stop

