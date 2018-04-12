@extends("layouts.default")
@section("title","home")

@section('date', $article->created_at->diffForHumans())
@section('avatar', $article->user->avatar)
@section('name', $article->user->name)
@section('user_link', route('users.show', $article->user))


@section('functions')
                @if(Auth::check())
                    @if ($article->user->id == Auth::user()->id)
                        <div class="row icon-row" style="margin-top: 50px;">
                            <a href="{{ $article->work_or_tutorial ? route('tutorials.edit', $article->id) : route('articles.edit', $article) }}">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>编　　辑</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="row icon-row">
                            <form action="{{ route('articles.destroy', $article->id) }}" method="post" id="delete-article-form">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                                    <div class="col-xs-10 col-xs-offset-1 background-block" id="delete-article-form-button">
                                        <div class="center-block">
                                            <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                                            <div class="icon-text-list">
                                                <p>删　　除</p>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        @if($article->is_assigned)
                            <div class="row icon-row">
                                <div class="col-xs-10 col-xs-offset-1 background-block ">
                                    <div class="center-block">
                                        <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>已经点燃</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if(!$article->work_or_tutorial)
                                <div class="row icon-row">
                                    <form action="{{ route('purchases.ignite', $article->id) }}" method="post" class="ignite-form">
                                        {{ csrf_field() }}
                                    </form>
                                    <div class="col-xs-10 col-xs-offset-1 background-block ignite">
                                        <div class="center-block">
                                            <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                                            <div class="icon-text-list">
                                                <p>点燃柴堆</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                    @else
                            <!--            功能列表            -->
                            @cannot('update', $article->user)
                                @if(Auth::user()->isFollowing($article->user->id))
                                    <div class="row icon-row">
                                        <div class="col-xs-10 col-xs-offset-1 background-block unfollow">
                                            <div class="center-block">
                                                <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                                <div class="icon-text-list">
                                                    <p>取消关注</p>
                                                </div>
                                                <form action="{{ route('followers.destroy', $article->user->id) }}" method="post" class="unfollow-form">
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
                                                    <p>关注作者</p>
                                                </div>
                                                <form action="{{ route('followers.store', $article->user->id) }}" method="post" class="follow-form">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endcannot

                            @cannot('update', $article->user)
                                @if(Auth::user()->isCollecting($article->id)    )
                                    <div class="row icon-row">
                                        <div class="col-xs-10 col-xs-offset-1 background-block uncollect">
                                            <div class="center-block">
                                                <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                                                <div class="icon-text-list">
                                                    <p>取消收藏</p>
                                                </div>
                                                <form action="{{ route('collections.destroy', $article) }}" method="post" class="uncollect-form">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row icon-row">
                                        <div class="col-xs-10 col-xs-offset-1 background-block collect">
                                            <div class="center-block">
                                                <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                                                <div class="icon-text-list">
                                                    <p>收　　藏</p>
                                                </div>
                                                <form action="{{ route('collections.store', $article) }}" method="post" class="collect-form">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endcannot
                            <div class="row icon-row">
                                <div class="col-xs-10 col-xs-offset-1 background-block purchase">
                                    <div class="center-block">
                                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>添三根柴</p>
                                        </div>
                                        <form action="{{ route('purchases.store', $article->id) }}" method="post" class="purchase-form">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                    @endif
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

@section('contents')
                <!--            主要内容             -->
                @include('shared._message')

                <div class="row">
                    <div class="col-xs-12 content-col">
                        <div class="center-block content">
                            <div class="content-info">
                                <h2>
                                    {{ $article->title }}<br/>
                                    <small>{{ $article->category->name }}</small>
                                </h2>
                            </div>
                            <div class="content-main">
                                {!! $article->content  !!}
                            </div>
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

@section("script")
    <script>
        $(function(){
            $("#delete-article-form-button").click(function(){
               $("#delete-article-form").submit();
            });
        });
    </script>

@stop