<!-- Modal Change Password-->
<div class="modal fade" id="modal_change_pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left" id="form_change_pass">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="pass_old">Old Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control col-md-7 col-xs-12" name="pass_old">
                            <span id="pass_old_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="pass_new">New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control col-md-7 col-xs-12" name="pass_new">
                            <span id="pass_new_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="pass_conf">Password Confirmation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control col-md-7 col-xs-12" name="pass_conf">
                            <span id="pass_conf_error" class="text-danger"></span>
                        </div>
                    </div>
                    <input type="hidden" class="form-control col-md-7 col-xs-12" name="id_user" value="<?= $this->session->userdata('userid') ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetChangePass()">Close</button>
                <button type="submit" class="btn btn-primary" id="saveChange">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Change Password-->

<!-- Modal Profile User-->
<div class="modal fade" id="modal_show_profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left" id="form_show_profile">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-6" for="show_username">Search Key
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" id="show_username" name="show_username">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="show_name">Full Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="show_name">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="show_password">Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control col-md-7 col-xs-12" name="show_password">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="checkbox">
                                <label class="col-sm-3">
                                    <input type="checkbox" name="show_active"> Active
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal Profile User-->