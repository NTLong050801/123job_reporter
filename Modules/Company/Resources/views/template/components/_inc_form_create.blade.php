<div class="row" id="form-create">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">
                <form action="http://admin.timnha247.abc/company/announcements/store" method="POST"
                      class="form-horizontal">
                    <input type="hidden" name="_token" value="6lnTHNuQ5v9LYEcAIOVnAbTi8Jz3XNTvvV4cRGBw">
                    <div class="form-group clearfix ">
                        <label class="col-sm-4">Công ty <b class="text-danger">(*)</b></label>
                        <div class="col-sm-7">
                            <select name="company_id" class="form-control" id="company_id">
                                <option value="">-- Công ty --</option>
                                <option value="1">
                                    Vnp group
                                </option>
                                <option value="2">
                                    --- WeLove
                                </option>
                                <option value="3">
                                    --- Công ty cổ phần WeHelp
                                </option>
                                <option value="4">
                                    --- Westay
                                </option>
                                <option value="9">
                                    --- Công ty cổ phần Vật Giá Việt Nam
                                </option>
                                <option value="14">
                                    ------ Vật giá - Hà Nội
                                </option>
                                <option value="15">
                                    ------ Vật giá - Hồ Chí Minh
                                </option>
                                <option value="16">
                                    ------ Vật giá - Hải Phòng
                                </option>
                                <option value="10">
                                    --- Công ty cổ phần TMDT Bảo Kim
                                </option>
                                <option value="12">
                                    ------ Bảo Kim - Hà Nội
                                </option>
                                <option value="13">
                                    ------ Bảo Kim - Hồ Chí Minh
                                </option>
                                <option value="11">
                                    --- Công ty TNHH Nguồn Nhân Lực Elite Việt Nam
                                </option>
                                <option value="5">
                                    Công ty cổ phần Nhanh.vn
                                </option>
                                <option value="6">
                                    --- Nhanh.vn HCM
                                </option>
                                <option value="7">
                                    --- Nhanh.vn HN
                                </option>
                                <option value="8">
                                    --- Nhanh - Đà Nẵng
                                </option>
                                <option value="17">
                                    Công ty cổ phần talent HR
                                </option>
                                <option value="18">
                                    --- Talent Hr - Hà Nội
                                </option>
                                <option value="19">
                                    --- Talent Hr - Hồ Chí Minh
                                </option>
                                <option value="20">
                                    Talent Hr - Hải Phòng
                                </option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-4 required">Loại thông báo: <b class="text-danger">(*)</b></label>
                        <div class="col-md-7">
                            <select name="type" id="type" class="form-control">
                                <option value="" selected="selected">- Loại -</option>
                                <option value="1"> Quyết định</option>
                                <option value="2"> Thông báo</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group clearfix ">
                        <label class="col-sm-4">Tên thông báo: <b class="text-danger">(*)</b></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" value="" placeholder="Tên thông báo">

                        </div>
                    </div>

                    <div class="form-group clearfix ">
                        <label class="col-sm-4">Gắn nhãn:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="hash_tag" value="" placeholder="hash_tag">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4"></label>
                        <div class="col-sm-7">
                            <label class="radio radio-inline">
                                <input type="radio" value="0" name="status">Ẩn</label>
                            <label class="radio radio-inline">
                                <input type="radio" value="1" name="status">Hiện</label>
                            <ul class="nav parsley-description-list">
                                <li>nội dung bị ẩn sẽ chỉ có bạn xem được thông báo!</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-md-4">File upload:</label>
                        <div class="col-md-8"><input type="file" name="fileUpload[]" multiple="multiple"
                                                     id="fileUpload"></div>
                    </div>

                    <div class="form-group"><label class="col-md-4"> Bắt buộc đọc:</label>
                        <div class="col-md-8">
                            <input type="hidden" name="must_read" value="0">
                            <label for="must_read">
                                <input type="checkbox" name="must_read" id="must_read" value="1"> Thông báo bắt buộc
                                nhân
                                viên đọc
                            </label>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-4 required">Nội dung thông báo: <span class="required">*</span> </label>
                        <div class="col-md-7">
                            <textarea name="content" class="form-control" cols="30" rows="5"
                                      placeholder="Nhập nội dung thông báo"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label class="col-sm-3">Sau khi lưu</label>
                        <span class="col-sm-7 col-md-offset-1">
            <label for="next">
                <input type="radio" id="next" name="redirect" checked="" value="0">
                Tiếp tục
            </label> &nbsp;
            <label for="back">
                <input type="radio" id="back" name="redirect" value="1">
                Hiện danh sách
            </label>
        </span>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button type="submit" class="btn btn-success">Lưu lại</button>
                            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
