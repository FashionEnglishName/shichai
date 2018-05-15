@extends('layouts.default')
@section('title','发布作品')

    @section('style')
        <link rel="stylesheet" href="/css/simditor.css">
    @endsection

    @section('script')
    <script type="text/javascript"  src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.js') }}"></script>
    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('articles.upload_image') }}',
                    params: { _token: '{{ csrf_token() }}' },
                    fileKey: 'upload_file',
                    connectionCount: 10,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true
            });

            $('#edit-cover').click(function(){
                $('#edit-cover-modal').modal();
            });

            $image = $('#cover-cropper');
            var options = {
                aspectRatio: 211 / 158,
                viewMode: 2,
                preview: '.cover-preview',
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

            $('#edit-cover-modal').on("shown.bs.modal",function(){
                $image.cropper(options);
            });

            $(".cover-select").change(function(){
                $image.cropper('destroy').attr('src', URL.createObjectURL(this.files[0])).cropper(options);
                $('.box-for-cover').removeClass('now-you-cannot-see-me');
                $('.box-for-non-cover').addClass('now-you-cannot-see-me');
                console.log(this.files);
                console.log(URL.createObjectURL(this.files[0]));
            });

            var result;
            $("#cover-upload").click(function(e){
                e.preventDefault();
                result = $image.cropper('getCroppedCanvas', options)
                console.log(result);
                var imgBase=result.toDataURL('image/jpeg');
                console.log(imgBase);
                var data={imgBase:imgBase};
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#cover-upload-form input[name="_token"]').val()
                    }
                });

                $.ajax({
                    url:  "{{ route('articles.upload_cover') }}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function(data){
                        console.log(data);
                        $('#cover-url').val(data.path);
                        console.log($('#cover-url').text());
                        $('#cover-preview-out-of-modal').attr('src', data.path);
                        $('#cover-preview-out-of-modal').removeClass('now-you-cannot-see-me');
                        $('#non-cover-preview-out-of-modal').addClass('now-you-cannot-see-me');

                    },
                    error: function(data){
                        console.log(data);
                    }
                });

            });
        });
    </script>
    @endsection

    @section('functions')
        <!--            功能列表            -->
        <div class="row icon-row" style="padding-top:50px">
            <div class="col-xs-10 col-xs-offset-1 background-block" id="edit-article-form-submit">
                <div class="center-block">
                    <img src="/imgs/recommand-icon.png" alt="recommand" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>提　　交</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-row">
            <div class="col-xs-10 col-xs-offset-1 background-block">
                <div class="center-block">
                    <img src="/imgs/bought-icon.png" alt="bought" class="icon-list center-block">
                    <div class="icon-text-list">
                        <p>返　　回</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@section('contents')

    <div class="col-xs-10 col-xs-offset-1">
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
                    <form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data" id="edit-article-form">
                        {{ method_field('PATCH') }}
                        @else
                            <form action="{{ route('articles.store') }}" method="post" id="edit-article-form" enctype="multipart/form-data">
                                @endif
                                {{csrf_field()}}
                                <input type="text" hidden name="cover" id="cover-url">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
                                </div>

                                <div class="form-group">
                                    <select name="category_id" required class="form-control" autocomplete="off">
                                        <option value="" hidden disabled>请选择分类</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ isset($article->id) && $article->category->id == $category->id ? 'selected' : '' }}>{{ str_replace_array('　', ['', ''], $category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="content" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" class="form-control" required>{{ old('content', $article->content) }}</textarea>
                                </div>


                                    {{--@if ($article->cover)--}}
                                        {{--<br>--}}
                                        {{--<img src="{{ $article->cover }}" width="200" class="thumbnail">--}}
                                    {{--@endif--}}
                            </form>
                            <div>
                                <img class="now-you-cannot-see-me" id="cover-preview-out-of-modal" src="{{ $article->cover }}" alt="封面" style="width: 211px; height: 158px;">
                                <div id="non-cover-preview-out-of-modal" style="width: 211px; height: 158px; border: dotted 1px #dddddd;"></div>
                            </div>
                            <button type="button" id="edit-cover">上传封面</button>

            </div>
        </div>
    </div>

    @include('modals.edit_cover')


@endsection


@section('script')
@stop