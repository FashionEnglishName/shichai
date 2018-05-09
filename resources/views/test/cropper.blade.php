<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/cropper.css">
    <script language="JavaScript" src="/js/app.js"></script>
    <script language="JavaScript" src="/js/cropper.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col-xs-8">
            <div class="box" style="width: 500px;">
                <img src="{{ Auth::user()->avatar }}" alt="avatar" id="avatar-test" style="max-width: 100%;">
            </div>

        </div>
        <div class="col-xs-4">
            <div class="img-preview" style="height: 200px; overflow: hidden">
            </div>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('test.upload') }}" method="post" enctype="multipart/form-data" id="test-form">
            {{ csrf_field() }}
            <input type="file" class="avatar-select">
            <button type="submit" id="avatar-submit">提交</button>
        </form>
    </div>


</body>
<script>
    $(function(){
        $('#avatar-test').cropper({
            aspectRatio: 1,
            viewMode: 2,
            preview: '.img-preview',
            crop: function(event) {
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                console.log(event.detail.rotate);
                console.log(event.detail.scaleX);
                console.log(event.detail.scaleY);
            }
        });

        var cropper = $('#avatar-test').data('cropper');
        var options = {
            aspectRatio: 1,
            viewMode: 2,
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

        $(".avatar-select").change(function(){
            $('#avatar-test').cropper('destroy').attr('src', URL.createObjectURL(this.files[0])).cropper({
                aspectRatio: 1,
                viewMode: 2,
                crop: function(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            });
//            console.log(this.files);
//            console.log(URL.createObjectURL(this.files[0]));
        });

        var result;
        $("#avatar-submit").click(function(e){
            e.preventDefault();
            result = $('#avatar-test').cropper('getCroppedCanvas', options)
            console.log(result);
            var imgBase=result.toDataURL('image/jpeg');
            console.log(imgBase);
            var data={imgBase:imgBase};
            console.log(data);
//            $.post('/test/upload', data, function(ret) {
//                if(ret==='true'){
//                    alert('上传成功');
//                }else{
//                    alert('上传失败');
//                }
//            }, 'text');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('#test-form input[name="_token"]').val()
                }
            });
            $.ajax({
                url: '/test/upload',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(data){
                    alert('success');
                    console.log(data);
                },
                error: function(data){
                    alert('error');
                    console.log(data);
                }
            });
        });
    });
</script>
</html>