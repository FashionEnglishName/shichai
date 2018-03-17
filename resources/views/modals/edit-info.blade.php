<div class="modal fade" tabindex="-1" role="dialog" id="edit-info-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">修改资料</h4>
            </div>

            <form action="" method="POST" id="edit-info-form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="id" id="edit-info-user-id" hidden value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" id="edit-email" disabled>
                    </div>

                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" id="edit-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">修改</button>
                </div>
            </form>
        </div>
    </div>
</div>