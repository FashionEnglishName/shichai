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
                        <div class="box-for-cover {{ isset($article->cover) ? '' : 'now-you-cannot-see-me' }} " style="width: 400px; height: 400px; float:left;">
                            <img src="{{ isset($article->cover) ? $article->cover : '' }}" alt="封面" id="cover-cropper" style="max-width: 100%;">
                        </div>
                        <div class=" {{ isset($article->cover) ? 'now-you-cannot-see-me' : '' }} box-for-non-cover" style="width: 400px; height: 400px; float:left; font-size: 20px; color: #ffffff; background-color: #7b7b7b">
                            <p class="text-center"></p>
                        </div>

                        <div class="cover-preview-wrapper">
                            <p class="text-center"><span style="color: #777777; ">封面预览</span></p>
                            <div class="cover-preview">

                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" id="cover-upload-form" hidden>
                            {{ csrf_field() }}
                        </form>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="upload-file">
                            <input type="file" class="cover-select">
                            <span>选择封面</span>
                        </div>
                    </div>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="cover-upload" data-dismiss="modal">提交</button>
            </div>
        </div>
    </div>
</div>