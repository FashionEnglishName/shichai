@extends('layouts.default')
@section('title','分类')

@section('functions')
    @if(Auth::check())
        <div class="row"  style="height:50px">

        </div>
        @foreach($categories as $category)

            <div class="row icon-row">
                <a href="/category/{{ $category->id }}">
                    <div class="col-xs-10 col-xs-offset-1 background-block {{ $category->id == $id ? 'black-background-selected' : ' ' }}">
                        <div class="center-block">
                            <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                            <div class="icon-text-list">
                                <p>{{ $category->name }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        @endforeach

    @else
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

@section('category','li-active')

@section('contents')
    <!--            二级导航栏            -->
    <div class="row">
        <div class="col-xs-12" id="second-navbar-row">
            <div class="navbar navbar-default" id="second-navbar" role="navigation">
                <div class="container">
                    <ul class="nav navbar-nav" id="second-navbar-text">
                        <li @if($order === 'default'||!isset($order))class="li-active" @endif><a href="{{ Request::url() }}?order=default">最热</a></li>
                        <li @if($order === 'recent')class="li-active" @endif><a href="{{ Request::url() }}?order=recent">最新</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts._articles-panel', ['articles' => $articles])
@stop

