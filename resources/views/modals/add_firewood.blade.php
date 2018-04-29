<div class="modal fade" id="purchase-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>要添几根柴火？</h4>
            </div>
            <div class="modal-body">
                <form id="purchase-form" action="{{ route('purchases.store', $article->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="firewood" id="firewoodRadio1" value="1" hidden>
                                    <button class="btn btn-default btn-firewoodRadio" id="btn-firewoodRadio1">1根</button>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="firewood" id="firewoodRadio2" value="3" hidden>
                                    <button class="btn btn-default btn-firewoodRadio" id="btn-firewoodRadio2">3根</button>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="firewood" id="firewoodRadio3" value="5" hidden>
                                    <button class="btn btn-default btn-firewoodRadio" id="btn-firewoodRadio3">5根</button>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="firewood" id="firewoodRadio4" value="10" hidden>
                                    <button class="btn btn-default btn-firewoodRadio" id="btn-firewoodRadio4">10根</button>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">关闭</button>
                <button class="btn btn-primary" type="button" id="purchase-submit-button">确定</button>
            </div>
        </div>
    </div>
</div>