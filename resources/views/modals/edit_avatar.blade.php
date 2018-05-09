<div class="modal fade" tabindex="-1" role="dialog" id="edit-avatar-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box-for-avatar" style="width: 400px; float:left;">
                            <img src="{{ $user->avatar }}" alt="头像" id="avatar-cropper" style="max-width: 100%;">
                        </div>
                        <div class="avatar-preview-wrapper">
                            <p class="text-center"><span style="color: #777777;">头像预览</span></p>
                            <div class="avatar-preview">

                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" id="avatar-upload-form" hidden>
                            {{ csrf_field() }}
                        </form>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-3 col-xs-offset-2">
                        <div class="upload-file">
                            <input type="file" class="avatar-select">
                            <span>重新选择头像</span>
                        </div>
                    </div>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="avatar-upload">提交</button>
            </div>
        </div>
    </div>
</div>