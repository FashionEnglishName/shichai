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
        });
    </script>
    @endsection

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
                    <form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @else
                            <form action="{{ route('articles.store') }}" method="post"  enctype="multipart/form-data">
                                @endif
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
                                </div>

                                <div class="form-group">
                                    <select name="category_id" required class="form-control" autocomplete="off">
                                        <option value="" hidden disabled>请选择分类</option>
                                        @foreach($categories as $category)
                                            <script>console.log({{ $category->id }})</script>
                                            <option value="{{ $category->id }}" {{ isset($article->id) && $article->category->id == $category->id ? 'selected' : '' }}>{{ str_replace_array('　', ['', ''], $category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="content" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" class="form-control" required>{{ old('content', $article->content) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">上传封面</label>
                                    <input type="file" name="cover">

                                    @if ($article->cover)
                                        <br>
                                        <img src="{{ $article->cover }}" width="200" class="thumbnail">
                                    @endif
                                </div>

                                <div class="well well-sm">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                                </div>

                            </form>


            </div>
        </div>
    </div>



@endsection
