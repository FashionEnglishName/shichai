<div class="modal fade" tabindex="-1" role="dialog" id="edit-password-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">修改密码</h4>
            </div>

            <form action="" method="POST" id="edit-password-form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="id" id="edit-password-user-id" hidden value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="email" class="form-control" value="" id="edit-password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirmation">确认密码：</label>
                        <input type="password" name="password-confirmation" class="form-control" value="" id="edit-password-confirmation">
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