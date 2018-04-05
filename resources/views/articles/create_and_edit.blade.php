@extends('layouts.default')
@section('title','发布作品')

    @section('functions')
        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>我的关注</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/favourite-icon.png" alt="favourite" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>我的收藏</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>已购项目</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/message-icon.png" alt="message" class="icon-list center-block">
                    <div class="icon-text-list ">
                        <p>消息通知</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
        <h2 class="text-center">
            <i class="glyphicon glyphicon-edit"></i>
            @if($article->id)
                编辑文章
            @else
                新建文章
            @endif
        </h2>

        <hr>

        @include('shared._errors')

        @if($article->id)
            <form action="{{ route('articles.update') }}" method="post">
                {{ method_field('PATCH') }}
        @else
            <form action="{{ route('articles.create') }}" method="post">
        @endif
                {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
                </div>


            </form>


    </div>
</div>

@endsection