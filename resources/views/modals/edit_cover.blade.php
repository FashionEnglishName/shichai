<div class="modal fade" tabindex="-1" role="dialog" id="edit-cover-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box-for-cover" style="width: 400px; float:left;">
                            <img src="{{ isset($article) ? $article->cover : '' }}" alt="头像" id="cover-cropper" style="max-width: 100%;">
                        </div>
                        <div class="cover-preview">

                        </div>
                        <div><span>封面预览</span></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="upload-file">
                            <input type="file" class="cover-select">
                            <span>重新选择封面</span>
                        </div>
                    </div>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="cover-upload">提交</button>
            </div>
        </div>
    </div>
</div>