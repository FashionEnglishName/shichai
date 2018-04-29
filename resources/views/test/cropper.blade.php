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
    <div class="box">
        <img src="{{ \App\Models\User::find(10)->avatar }}" alt="avatar" id="avatar-test" style="max-width: 100%;">
    </div>
</body>
<script>
    $(function(){
        $('#avatar-test').cropper({
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

        var cropper = $('#avatar-test').data('cropper');
    });
</script>
</html>