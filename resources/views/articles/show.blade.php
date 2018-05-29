@extends("layouts.default")
@section("title","home")

@section('date')
    <span class="glyphicon glyphicon-time"></span> &nbsp;{{ $article->created_at->diffForHumans() }}
@stop
@section('avatar', $article->user->avatar)
@section('name', $article->user->name)
@section('user_link', route('users.show', $article->user->id))
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
                            <form action="{{ route('articles.destroy', $article->id) }}" method="post" id="delete-article-form" hidden>
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
                            @if(!$article->work_or_tutorial && $article->firewood_count>0)
                                <div class="row icon-row">
                                    <form action="{{ route('purchases.ignite', $article->id) }}" method="post" class="ignite-form" hidden>
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
                                    <div class="row icon-row" style="margin-top: 50px">
                                        <div class="col-xs-10 col-xs-offset-1 background-block unfollow">
                                            <div class="center-block">
                                                <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                                <div class="icon-text-list">
                                                    <p>取消关注</p>
                                                </div>
                                                <form action="{{ route('followers.destroy', $article->user->id) }}" method="post" class="unfollow-form" hidden>
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row icon-row" style="margin-top: 50px">
                                        <div class="col-xs-10 col-xs-offset-1 background-block follow">
                                            <div class="center-block">
                                                <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                                <div class="icon-text-list">
                                                    <p>关注作者</p>
                                                </div>
                                                <form action="{{ route('followers.store', $article->user->id) }}" method="post" class="follow-form" hidden>
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
                                                <form action="{{ route('collections.destroy', $article) }}" method="post" class="uncollect-form" hidden>
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
                                                <form action="{{ route('collections.store', $article) }}" method="post" class="collect-form" hidden>
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endcannot
                            @if($article->work_or_tutorial == 0)
                            <div class="row icon-row">
                                <div class="col-xs-10 col-xs-offset-1 background-block purchase">
                                    <div class="center-block">
                                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>添　　柴</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('refund', $article)
                                <div class="row icon-row">
                                    <div class="col-xs-10 col-xs-offset-1 background-block refund">
                                        <div class="center-block">
                                            <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                                            <div class="icon-text-list">
                                                <p>取回柴火</p>
                                            </div>
                                            <form action="{{ route('purchases.destroy', $article->id) }}" method="post" hidden id="refund-form">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @endif
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
                {{--@include('shared._message')--}}

                <div class="row">
                    <div class="col-xs-12 content-col">
                        <div class="center-block content">
                            <div class="content-info">
                                <h2>
                                    {{ $article->title }}
                                    <small><label class="label label-default"><a href="{{ route('category', $article->category->id) }}">{{ $article->category->name }}</a></label></small>
                                    <br>
                                    <small>　</small>
                                    <small>
                                        <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>&nbsp;{{ $article->firewood_count }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{ $article->collection_count }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span title="{{ $article->tutorial_id ? "已有教程" : "教程未出" }}"><span class="glyphicon glyphicon-book"></span>&nbsp;@if($article->tutorial_id)<span style="position: relative; bottom: 3px; font-size:11px;">√</span>@else<span style="position: relative; bottom: 1px; font-size:12px;">X</span>@endif</span>
                                    </small>
                                    <br>
                                    <small>　</small>
                                    <small>
                                        <span>我已添柴 {{ $firewood_sum }} 根</span>
                                    </small>
                                    {{--                                    <small>{{ $article->created_at !== $article->updated_at ? "作者于 " . $article->updated_at->diffForHumans() . " 更新" : '' }}</small>--}}
                                </h2>
                            </div>
                            <hr>
                            <div class="content-main center-block">
                                {!! $article->content  !!}
                            </div>
                        </div>
                    </div>
                </div>
@stop

@include('modals.add_firewood')

@section("script")
    <script>
        $(function(){
            $("#delete-article-form-button").click(function(){
               $("#delete-article-form").submit();
            });
        });
    </script>

@stop