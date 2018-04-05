@extends("layouts.default")
@section("title","home")

@section('date', $article->created_at->diffForHumans())


@section('functions')
                @if(Auth::check())
                    @can('update', $article->user)
                        <div class="row icon-row" style="margin-top: 50px;">
                            <a href="{{ route('articles.edit', $article) }}">
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
                    @elsecan
                            <!--            功能列表            -->
                            <div class="row icon-row" style="padding-top:50px">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>关　　注</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>收　　藏</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>添　　柴</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="col-xs-10 col-xs-offset-1 background-block">
                                    <div class="center-block">
                                        <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                                        <div class="icon-text-list">
                                            <p>喜　　爱</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endcan
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