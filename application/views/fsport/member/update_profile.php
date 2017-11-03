<!-- checkout -->
<!-- Date time picker -->
<link href="/assets/templates/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<style>
    .kv-avatar .krajee-default.file-preview-frame,
    .kv-avatar .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }

    .kv-avatar .file-input {
        display: table-cell;
        max-width: 220px;
    }

    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }
</style>
<div class="checkout">
    <div class="container">
        <?php if($this->session->flashdata('flash_ss')){?>
        <div class="alert alert-success fade in">
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('flash_ss')?>.
        </div>
        <?php }?>
        <?php if($this->session->flashdata('flash_er')){?>
        <div class="alert alert-danger fade in">
            <strong>Error!</strong>
            <?php echo $this->session->flashdata('flash_er')?>.
        </div>
        <?php }?>
        <h3>Cập nhật <span>thông tin</span></h3>
        <div class="checkout-right member info">
            <div class="row">
            <form class="form-validate form-horizontal" id="user_form" method="post" enctype="multipart/form-data">    
                <div class="col-sm-3">
                        <div class="kv-avatar center-block text-center" style="width:200px">
                            <input id="avatar-1" name="hinhanh" type="file" class="file-loading">
                            <div class="help-block"><small>Kích thước cho phép < 1000 KB</small></div>
                        </div>
                        <div id="kv-avatar-errors-1" class="center-block" style="display:none"></div>
                        <hr>
                        <ul>
                            <li><a href="<?= base_url('member/update-profile')?>">Cập nhật thông tin</a></li>
                            <li> <a href="<?= base_url('member/order-history')?>">Lịch sử mua hàng</a></li>
                        </ul>
                </div>
                <div class="col-sm-9">
                    
                        <div class="form">
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Tên người dùng:</label>
                                <div class="col-lg-6">
                                    <input class="form-control" name="username" type="text" value="<?= set_value('username', $arr_user_profile['userName']) ?>"
                                        disabled="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;);">
                                </div>

                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Mật khẩu: <span class="required">*</span></label>
                                <div class="col-lg-5">
                                    <a class="form-control btn btn-default" href="<?= base_url('/member/change-password')?>"><span class="fa fa-pencil"></span> Đổi mật khẩu</a>

                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-lg-3">Email <span class="required">*</span></label>
                                <div class="col-lg-6">
                                    <input class="form-control" name="email" type="email" value="<?= set_value('email', $arr_user_profile['userEmail'])?>">
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('email')?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Họ và tên <span class="required">*</span></label>
                                <div class="col-lg-6">
                                    <input class="form-control" name="fullname" type="text" value="<?= set_value('fullname', $arr_user_profile['userFullName'])?>">
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('fullname')?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Ngày sinh</label>

                                <div class="input-group date form_date col-lg-6" style="padding: 0 15px !important;">
                                    <input class="form-control" name="ngaysinh" type="text" value="<?= set_value('ngaysinh', $arr_user_profile['userBirthday'])?>"
                                        readonly="">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('ngaysinh')?>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-lg-3">Số điện thoại</label>
                                <div class="col-lg-6">
                                    <input class="form-control" name="dienthoai" type="text" minlength="10" value="<?= set_value('dienthoai', $arr_user_profile['userPhone'])?>">
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('dienthoai')?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Giới tính</label>
                                <div class="col-lg-6">
                                    <input type="radio" name="gioitinh" value="1" <?=set_value( 'gioitinh', $arr_user_profile[ 'userSex'])==1 ? 'checked' :
                                        ''?>> Nam
                                    <input type="radio" name="gioitinh" value="0" <?=set_value( 'gioitinh', $arr_user_profile[ 'userSex'])==0 ? 'checked' :
                                        ''?>> Nữ
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('gioitinh')?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Địa chỉ</label>
                                <div class="col-lg-6">
                                    <input class="form-control" name="diachi" type="text" maxlength="100" value="<?= set_value('diachi', $arr_user_profile['userAddress'])?>">
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('diachi')?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Quận / huyện</label>
                                <div class="col-lg-6">
                                    <input class="form-control" name="quanhuyen" type="text" maxlength="100" value="<?= set_value('quanhuyen', $arr_user_profile['userDistrict'])?>">
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('quanhuyen')?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-3">Tỉnh thành</label>
                                <div class="col-lg-6">
                                    <select class="form-control" name="thanhpho">
                                            <option value="">- Chọn - </option>
                                            <?php
                                        if(isset($arrCity)){
                                            foreach ($arrCity as $key => $value){
                                        ?>
                                                <option value="<?php echo $value['cityID']?>" <?php echo set_value('thanhpho', $arr_user_profile['cityID']) == $value['cityID']?"selected":""?>><?php echo $value['cityName']?></option>
                                        <?php
                                            }
                                        }

                                        ?>
                                        </select>
                                </div>
                                <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('thanhpho')?>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 50px">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <input class="btn btn-primary" type="submit" name="btn_save" value="Lưu">
                                    <input class="btn btn-default" type="reset" value="Nhập lại">
                                </div>
                            </div>
                        </div>
                </div>
            </form>
            </div>
        </div>
        <div class="checkout-left">

            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script src="/assets/templates/admin/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="/vendor/kartik-v/bootstrap-fileinput/js/locales/vi.js"></script>
<script type="text/javascript">
    $('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: 'yyyy-mm-dd'
    });
    $("#avatar-1").fileinput({
        overwriteInitial: true,
        maxFileSize: 1000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Xóa và chọn lại',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="<?= IMG_UPLOAD.'/'.$arr_user_profile['userAvatar']?>" alt="Your Avatar" width="100%">',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });
</script>
<!-- //checkout -->