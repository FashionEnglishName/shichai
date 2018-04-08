@extends("layouts.default")
@section("title","home")

@section('avatar', $user->avatar)
@section('name', $user->name)
@section('user_link', route('users.show', $user))

@section("functions")
    <div class="row icon-row" style="padding-top:50px">
        <a href="{{ route('users.show', $user) }}">
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
    @can('update', $user)
        <div class="row icon-row">
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
                <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-info">
                    <div class="center-block">
                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>用户资料</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block" id="check-firewood-toggle">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>查看余额</p>
                        <input type="text" value="{{ $user->firewood_count }}" hidden id="firewood_count">
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @cannot('update', $user)
        @if(Auth::user()->isFollowing($user->id))
            <div class="row icon-row">
                <div class="col-xs-10 col-xs-offset-1 background-block unfollow">
                    <div class="center-block">
                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>取消关注</p>
                        </div>
                        <form action="{{ route('followers.destroy', $user->id) }}" method="post" class="unfollow-form">
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
                            <p>关　　注</p>
                        </div>
                        <form action="{{ route('followers.store', $user->id) }}" method="post" class="follow-form">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        @endif

    @endcannot
@endsection

@section('info')
    @include('users._info')
@endsection


@section('contents')
    <div class="col-xs-offset-2 col-xs-8">
        <h1>{{ $title }}</h1>
        <ul>
            @foreach($users as $u)
                <li>
                    <img src="{{ $u->avatar }}" alt="{{ $u->name }}">
                    <a href="{{ route('users.show', '$user->id') }}">{{ $u->name }}</a>
                </li>
            @endforeach
        </ul>

        {{ $users->render() }}
    </div>
@endsection