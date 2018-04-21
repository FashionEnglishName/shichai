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

@endsection

@section('info')
    @include('users._info')
@endsection

@section('contents')

    <div class="row page-background">
        <div class="panel col-xs-10 col-xs-offset-1 panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i>编辑个人资料
                </h4>
            </div>
            <div class="panel-body">
                <form action="{{ route('edit-info', $user) }}" method="post" id="edit-info-form" enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input type="text" class="form-control" name="name" id="name-field" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="age-field">年龄</label>
                        <select name="age" id="age-field" class="form-control" autocomplete="off">
                            @for($age = 10; $age <= 80; $age++)
                                <option {{ $user->age == $age ? 'selected="selected"' : ' ' }}>{{ old('age', $age) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender-field1">性别</label>
                        <br>
                            <input type="radio" id="gender-field1" name="gender" value="1" {{ $user->gender ? 'checked="checked"' : ' ' }}>男
                        &nbsp;
                            <input type="radio" id="gender-field2" name="gender" value="0" {{ $user->gender ? ' ' : 'checked="checked"' }}>女
                    </div>
                    <div class="form-group">
                        <label for="location-field">所在地</label>
                        <select name="province_id" id="province-field" class="form-control" autocomplete="off">
                            @foreach(App\Models\Province::all() as $province)
                                <option value="{{ $province->id }}" {{ old('province_id' ,$user->province_id == $province->id ? 'selected="selected"' : '') }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <select name="city_id" id="city-field" class="form-control" autocomplete="off">
                            @if(isset($user->city_id))

                                @foreach(App\Models\City::all()->where('pid', '=', $user->province_id) as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', $user->city_id == $city->id ? 'selected="selected"' : '') }}>{{ $city->name }}</option>
                                @endforeach

                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="occupation-field">职业</label>
                        <select name="occupation_id" id="occupation-field" class="form-control" autocomplete="off">
                            @foreach(App\Models\Occupation::all() as $occupation)

                                <option value="{{ $occupation->id }}" {{ old('occupation_id', $user->occupation_id == $occupation->id ? 'selected="selected"' : '') }}>{{ $occupation->name }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="avatar-label">用户头像</label>
                        <input type="file" name="avatar" id="avatar-input">

                        @if($user->avatar)
                            <br>
                            <img src="{{ $user->avatar }}" width="200" class="thumbnail">
                        @endif
                    </div>
                    <div class="well well-sm">
                        <button class="btn btn-primary" type="submit">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@include('shared._errors')

@endsection

@include('modals.edit-password')

@section('style')
    <style>
        .navbar {
            margin-bottom: 0;
        }
    </style>
@stop
