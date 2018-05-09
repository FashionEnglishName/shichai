@extends('layouts.default')
@section('title', '修改资料')


    @section('functions')

        <div class="row icon-row" style="padding-top:50px">
            <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-info-form-submit">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>保存修改</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-avatar">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list icon-text-list-four-words">
                        <p>修改头像</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <a href="{{ url()->previous()}}">
                <div class="col-xs-10 col-xs-offset-1 background-block">
                    <div class="center-block">
                        <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                        <div class="icon-text-list">
                            <p>返　　回</p>
                        </div>
                    </div>
                </div>
            </a>
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
                                <option {{ $user->age == $age ? 'selected="selected"' : ' ' }}>{{ $age }}</option>
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
                </form>
            </div>
        </div>
    </div>

@include('shared._errors')
@include('modals.edit_avatar')

@endsection

@section('style')
    <style>
        .navbar {
            margin-bottom: 0;
        }
    </style>
@stop

@section('script')
    <script>
        $(function(){
            var $image = $('#avatar-cropper');
            var options = {
                aspectRatio: 1,
                viewMode: 2,
                preview: '.avatar-preview',
                crop: function(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            };

            var cropper = $image.data('cropper');

            $(".avatar-select").change(function(){
                $image.cropper('destroy').attr('src', URL.createObjectURL(this.files[0])).cropper(options);
                console.log(this.files);
                console.log(URL.createObjectURL(this.files[0]));
            });


            $('#edit-avatar-modal').on("shown.bs.modal",function(){
                $image.cropper(options);
            });

//            $('#edit-avatar-modal').on("hidden.bs.modal", function(){
//                $image.cropper('destroy');
//            })
            var result;
            $("#avatar-upload").click(function(e){
                e.preventDefault();
                result = $image.cropper('getCroppedCanvas', options)
                console.log(result);
                var imgBase=result.toDataURL('image/jpeg');
                console.log(imgBase);
                var data={imgBase:imgBase};
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#avatar-upload-form input[name="_token"]').val()
                    }
                });
                $.ajax({
                    url: '{{ route("users.edit_avatar", Auth::id()) }}',
                    type: 'patch',
                    dataType: 'json',
                    data: data,
                    success: function(data){
                        toastr.success('修改成功');
                        setTimeout(function() {
                            window.location.href = '{{ route('users.show', Auth::id()) }}';
                        }, 1000);
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });

        });
    </script>

@stop