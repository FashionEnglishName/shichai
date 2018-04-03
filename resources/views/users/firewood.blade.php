@extends('layouts.default')
@section('title', '修改资料')

@section('functions')

    <div class="row icon-row" style="padding-top:50px">
        <a href="{{ route("users.show", $user) }}">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>主&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row icon-row" >
        <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-password-toggle">
            <div class="center-block">
                <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                <div class="icon-text-list">
                    <p>修改密码</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row icon-row">
        <a href="{{ route('users.edit', $user) }}">
            <div class="col-xs-10 col-xs-offset-1 background-block black-background-selected" id="edit-info">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list icon-text-list-four-words">
                        <p>用户资料</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

@endsection

@section('info')

    @include("users._info")

@endsection

@section('contents')



@endsection

@include('modals.edit-password')
