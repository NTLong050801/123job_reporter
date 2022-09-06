<div id="table-list">
    <div class="box box-default">
        <div class="box-header">
            <div class="form-search pull-left fFilterC">
                <form action="http://admin.timnha247.abc/company/company/index" method="get" class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Từ ngày" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Đến ngày" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Tên công ty" value="">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control" id="">
                            <option value="">-- Trạng thái --</option>
                            <option value="-1">Ngừng hoạt động</option>
                            <option value="1">Đang hoạt động</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="btn-group">
                            <button type="button" class="multiselect dropdown-toggle btn btn-default"
                                    data-toggle="dropdown" title="- Danh mục SP -" aria-expanded="true"><span
                                    class="multiselect-selected-text">- Danh mục SP -</span> <b class="caret"></b>
                            </button>
                            <ul class="multiselect-container dropdown-menu"
                                style="max-height: 350px; overflow: hidden auto;">
                                <li class="multiselect-item multiselect-filter" value="0">
                                    <div class="input-group"><span class="input-group-addon"><i
                                                class="glyphicon glyphicon-search"></i></span><input
                                            class="form-control multiselect-search" type="text"
                                            placeholder="Tìm kiếm"><span class="input-group-btn"><button
                                                class="btn btn-default multiselect-clear-filter" type="button"><i
                                                    class="glyphicon glyphicon-remove-circle"></i></button></span></div>
                                </li>
                                <li class="multiselect-item multiselect-all"><a tabindex="0"
                                                                                class="multiselect-all"><label
                                            class="checkbox"><input type="checkbox" value="multiselect-all"> Chọn tất cả</label></a>
                                </li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value=""> - Danh mục
                                            -</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="-1"> Chưa gắn
                                            danh mục</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381003"> Đồ
                                            nam</label></a></li>
                                <li class=""><a tabindex="0"><label class="checkbox"><input type="checkbox"
                                                                                            value="381012"> -- Áo tập
                                            nam</label></a></li>
                                <li class=""><a tabindex="0"><label class="checkbox"><input type="checkbox"
                                                                                            value="381014"> -- Quần tập
                                            nam</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381005"> Đồ nữ</label></a>
                                </li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381011"> -- Áo
                                            tập nữ</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381013"> --
                                            Quần tập nữ</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381006"> Phụ
                                            kiện</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381007"> --
                                            Thảm tập</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381008"> --
                                            Túi</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381009"> --
                                            Khăn tập</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="381010"> --
                                            Găng tay</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="422301">
                                            Voucher du lịch</label></a></li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="428960"> Sim 1</label></a>
                                </li>
                                <li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="479000"> test</label></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                        </button>
                        <a href="http://admin.timnha247.abc/company/company/index" class="btn btn-default">Làm mới</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="box-body">

            <div class="data-grid-header clearfix">
                <div class="button-groups pull-left">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            <i class="fa fa-plus"></i> Thêm mới <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="first"><a href="/customer/code/add"><i class="fa fa-plus"></i> Thêm khách
                                    hàng</a>
                            </li>
                            <li class="last"><a href="/import/customer/excelclient"><i class="fa fa-file-excel-o"></i>
                                    Import khách hàng từ Excel</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog"></i> Thao tác <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="first"><a id="excel" href="#"><i class="fa fa-file-excel-o"></i> Xuất excel trang
                                    hiện tại</a></li>
                            <li><a id="excelAll" href="#"><i class="fa fa-file-excel-o"></i> Xuất excel tất cả các trang</a>
                            </li>
                            <li><a href="javascript:;" id="deleteAll"><i class="fa fa-trash-o"></i> Xóa khách hàng đã
                                    chọn</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:;" id="sendSms" data-typesms="10"><i class="fa fa-envelope-o"></i>
                                    Gửi
                                    SMS cho khách hàng</a></li>
                            <li><a href="javascript:;" id="sendEmail"><i class="fa fa-at"></i> Gửi Email cho khách hàng</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/customer/care/addmoney?storeId=49137&amp;actionType=1" class="addCareLnk"><i
                                        class="fa fa-upload"></i> Tặng điểm</a></li>
                            <li><a href="/customer/care/addmoney?storeId=49137&amp;actionType=2" class="addCareLnk"><i
                                        class="fa fa-download"></i> Trừ điểm</a></li>
                            <li><a href="/customer/care/addmoney?storeId=49137&amp;actionType=5" class="addCareLnk"><i
                                        class="fa fa-usd"></i> Tặng tiền tích lũy</a></li>
                            <li><a href="/customer/care/addmoney?storeId=49137&amp;actionType=6" class="addCareLnk"><i
                                        class="fa fa-usd"></i> Trừ tiền tích lũy</a></li>
                            <li><a href="/customer/care/addother?storeId=49137&amp;actionType=7" class="addCareLnk"><i
                                        class="fa fa-phone"></i> Gọi điện</a></li>
                            <li><a href="/customer/care/addother?storeId=49137&amp;actionType=8" class="addCareLnk"><i
                                        class="fa fa-envelope-o"></i> Nhắn tin</a></li>
                            <li><a href="/customer/care/addother?storeId=49137&amp;actionType=9" class="addCareLnk"><i
                                        class="fa fa-at"></i> Gửi email</a></li>
                            <li><a href="/customer/care/addother?storeId=49137&amp;actionType=10" class="addCareLnk"><i
                                        class="fa fa-phone"></i> Nhận cuộc gọi</a></li>
                            <li class="last"><a href="javascript:;" id="udpateQuickGroupCustomer" data-typesms="10"><i
                                        class="fa fa-edit"></i> Cập nhật nhóm khách hàng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="btn-group pull-right dgColumnSelectors"><a data-toggle="dropdown"
                                                                           class="btn btn-sm btn-default dropdown-toggle"
                                                                           href="#"><i class="fa fa-check-square-o"
                                                                                       aria-hidden="true"
                                                                                       style="margin-right: 2px;"></i><span
                                class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu dropdown-menu-right userDgConfig" data-type="101">
                            <li class="first"><i class="fa fa-cog"></i> Cài đặt ẩn hiện cột</li>
                            <li role="presentation" class="divider"></li>
                            <li data-type="101" id="settingTypeDelete" style="cursor: pointer;"><i
                                    class="fa fa-share"></i> Quay về mặc định
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li><input type="checkbox" name="id" value="id" class="dgColumn" data-colspan="colSumary"
                                       data-class="dgColId"><span>ID</span></li>
                            <li><input type="checkbox" name="imagemanager" value="imagemanager" class="dgColumn"
                                       checked="" data-colspan="colSumary"
                                       data-class="dgColImagemanager"><span>Ảnh</span></li>
                            <li><input type="checkbox" name="barcode" value="barcode" class="dgColumn" checked=""
                                       data-colspan="colSumary" data-class="dgColBarcode"><span>Mã vạch</span></li>
                            <li><input type="checkbox" name="code" value="code" class="dgColumn"
                                       data-colspan="colSumary" data-class="dgColCode"><span>Mã</span></li>
                            <li><input type="checkbox" name="importPrice" value="importPrice" class="dgColumn"
                                       checked="" data-colspan="colSumary"
                                       data-class="dgColImportPrice"><span>Giá nhập</span></li>
                            <li><input type="checkbox" name="avgCost" value="avgCost" class="dgColumn" checked=""
                                       data-colspan="colSumary" data-class="dgColAvgCost"><span>Giá vốn</span></li>
                            <li><input type="checkbox" name="price" value="price" class="dgColumn" checked=""
                                       data-colspan="colSumary" data-class="dgColPrice"><span>Giá bán</span></li>
                            <li><input type="checkbox" name="priceVat" value="priceVat" class="dgColumn"
                                       data-colspan="colSumary" data-class="dgColPriceVat"><span>Giá bán + VAT</span>
                            </li>
                            <li><input type="checkbox" name="wholesalePrice" value="wholesalePrice" class="dgColumn"
                                       checked="" data-colspan="colSumary" data-class="dgColWholesalePrice"><span>Giá buôn</span>
                            </li>
                            <li><input type="checkbox" name="wholesalePriceVat" value="wholesalePriceVat"
                                       class="dgColumn" data-colspan="colSumary"
                                       data-class="dgColWholesalePriceVat"><span>Giá buôn + VAT</span></li>
                            <li><input type="checkbox" name="quantityRemain" value="quantityRemain" class="dgColumn"
                                       checked="" data-class="dgColQuantityRemain"><span>Tồn</span></li>
                            <li><input type="checkbox" name="totalQuantityRemain" value="totalQuantityRemain"
                                       class="dgColumn" checked=""
                                       data-class="dgColTotalQuantityRemain"><span>Tổng tồn</span></li>
                            <li><input type="checkbox" name="quantityDamaged" value="quantityDamaged" class="dgColumn"
                                       data-class="dgColQuantityDamaged"><span>Hàng lỗi (<i
                                        class="fa fa-warning fa-lg color-orange"></i>)</span></li>
                            <li><input type="checkbox" name="quantityShipping" value="quantityShipping" class="dgColumn"
                                       checked="" data-class="dgQuantityColShipping"><span>Đang giao hàng (<i
                                        class="fa fa-truck fa-lg color-blue"></i>)</span></li>
                            <li><input type="checkbox" name="remainByDepot" value="remainByDepot" class="dgColumn"
                                       checked="" data-class="dgColRemainByDepot"><span>Tồn trong kho (<i
                                        class="fa fa-home fa-lg color-blue"></i>)</span></li>
                            <li><input type="checkbox" name="quantityTransfer" value="quantityTransfer" class="dgColumn"
                                       data-class="dgColQuantityTransfer"><span>Đang chuyển kho (<i
                                        class="fa fa-exchange fa-lg color-blue"></i>)</span></li>
                            <li><input type="checkbox" name="quantityHold" value="quantityHold" class="dgColumn"
                                       checked="" data-class="dgColQuantityHold"><span>Tạm giữ (<i
                                        class="fa fa-archive fa-lg color-blue"></i>)</span></li>
                            <li><input type="checkbox" name="quantityAvailable" value="quantityAvailable"
                                       class="dgColumn" checked="" data-class="dgColQuantityAvailable"><span>Có thể bán (<i
                                        class="fa fa-check-square fa-lg color-green"></i>)</span></li>
                            <li><input type="checkbox" name="status" value="status" class="dgColumn" checked=""
                                       data-class="dgColStatus"><span>Bán</span></li>
                            <li><input type="checkbox" name="waittings" value="waittings" class="dgColumn"
                                       data-class="dgColWaittings"><span>Chờ nhập hàng</span></li>
                            <li><input type="checkbox" name="preOrder" value="preOrder" class="dgColumn"
                                       data-class="dgColPreOrder"><span>Đặt trước</span></li>
                            <li class="last"><input type="checkbox" name="action" value="action" class="dgColumn"
                                                    checked="" data-class="dgColAction"><span>Nút hành động (<i
                                        class="fa fa-cog"></i>)</span></li>
                        </ul>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="paginationControl">
                        <span>1 - 50 / 289        </span><a href="#" style="display:none"><i
                                class="fa fa-fast-backward"></i></a>
                        <a href="#" onclick="return false" class="a i">
                            1 </a>
                        <a class="i" href="/product/item/index?page=2">
                            2 </a>
                        <a class="i" href="/product/item/index?page=3">
                            3 </a>
                        <a class="i" href="/product/item/index?page=4">
                            4 </a>
                        <a class="i" href="/product/item/index?page=5">
                            5 </a>
                        <a class="i" href="/product/item/index?page=6">
                            6 </a>
                        <a class="ar" title="Trang cuối" href="/product/item/index?page=6"><i
                                class="fa fa-fast-forward"></i></a></div>
                </div>
            </div>

            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th width="4%">ID</th>
                    <th>
                        Ảnh
                    </th>
                    <th>Công ty mẹ</th>
                    <th>
                        <a href="/product/item/index?sort=name&amp;dir=desc"><i class="fa fa-sort"></i> Tên</a>
                    </th>
                    <th width="8%" class="text-center">Nhân viên</th>
                    <th width="8%" class="text-center">Phòng ban</th>
                    <th class="text-center">Trạng thái</th>
                    <th width="8%" class="text-center">Người tạo</th>
                    <th class="text-center"><a href="/product/item/index?sort=name&amp;dir=desc"><i
                                class="fa fa-sort"></i> Thời gian</a></th>
                    <th width="8%" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>20</td>
                    <td>
                        <a class="icon imageManager iconImageDefault" id="27832448" type="2">
                            <img
                                src="https://cdn.nhanh.vn/cdn/store1/49137/ps/20210207/bb2c5ee2_a957_4aea_bcbe_8ffb24479d95.jpeg">
                        </a>
                    </td>
                    <td>Owner</td>
                    <td>Talent Hr - Hải Phòng</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-danger">Ngừng hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-02-07 11:04:32</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>19</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần talent HR</td>
                    <td>Talent Hr - Hồ Chí Minh</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>18</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần talent HR</td>
                    <td>Talent Hr - Hà Nội</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>17</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Owner</td>
                    <td>Công ty cổ phần talent HR</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>16</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần Vật Giá Việt Nam</td>
                    <td>Vật giá - Hải Phòng</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>15</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần Vật Giá Việt Nam</td>
                    <td>Vật giá - Hồ Chí Minh</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>14</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần Vật Giá Việt Nam</td>
                    <td>Vật giá - Hà Nội</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>13</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần TMDT Bảo Kim</td>
                    <td>Bảo Kim - Hồ Chí Minh</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần TMDT Bảo Kim</td>
                    <td>Bảo Kim - Hà Nội</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Vnp group</td>
                    <td>Công ty TNHH Nguồn Nhân Lực Elite Việt Nam</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Vnp group</td>
                    <td>Công ty cổ phần TMDT Bảo Kim</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Vnp group</td>
                    <td>Công ty cổ phần Vật Giá Việt Nam</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần Nhanh.vn</td>
                    <td>Nhanh - Đà Nẵng</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần Nhanh.vn</td>
                    <td>Nhanh.vn HN</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Công ty cổ phần Nhanh.vn</td>
                    <td>Nhanh.vn HCM</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Owner</td>
                    <td>Công ty cổ phần Nhanh.vn</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Vnp group</td>
                    <td>Westay</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Vnp group</td>
                    <td>Công ty cổ phần WeHelp</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Vnp group</td>
                    <td>WeLove</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="dgColImagemanager colAct smz align-middle columnImg"><a
                            class="icon fa fa-plus-circle color-green imageManager" id="27832381" type="2"
                            title="Hạt trầm 6 ly"></a></td>
                    <td>Owner</td>
                    <td>Vnp group</td>
                    <td align="center">
                        <a href=""><span class="label label-info">0</span></a>
                    </td>
                    <td align="center">
                        <a href=""><span class="label label-success">1</span></a>
                    </td>
                    <td align="center">
                        <label class="label label-success">Đang hoạt động</label>
                    </td>
                    <td>Admin</td>
                    <td>2021-01-15 22:52:18</td>
                    <td align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="first"><a
                                        href="/product/item/detail?storeId=49137&amp;id=27832448&amp;tab=promotion"
                                        title="Thông tin khuyến mại"><i class="fa fa-gift"></i> Thông tin khuyến mại</a>
                                </li>
                                <li><a class="" href="/product/item/edit?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-edit"></i> Sửa sản phẩm</a></li>
                                <li><a class="deleteBtn" href="#"
                                       link="/product/item/delete?storeId=49137&amp;id=27832448"><i
                                            class="fa fa-trash-o"></i> Xóa sản phẩm</a></li>
                                <li><a data-toggle="modal" data-target="#myModal" class="packageShow lnk"
                                       link="/product/item/loaddata?tab=getpackages&amp;parentId=27832448"><i
                                            class="fa fa-list"></i> Sản phẩm trong gói</a></li>
                                <li></li>
                                <li><a href="/pos/bill/addpackage?copyId=27832448"><i class="fa fa-copy"></i> Copy gói
                                        sản phẩm</a></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="pull-right">
                <div class="paginationControl">
                    <span>1 - 50 / 289        </span><a href="#" style="display:none"><i
                            class="fa fa-fast-backward"></i></a>
                    <a href="#" onclick="return false" class="a i">
                        1 </a>
                    <a class="i" href="/product/item/index?page=2">
                        2 </a>
                    <a class="i" href="/product/item/index?page=3">
                        3 </a>
                    <a class="i" href="/product/item/index?page=4">
                        4 </a>
                    <a class="i" href="/product/item/index?page=5">
                        5 </a>
                    <a class="i" href="/product/item/index?page=6">
                        6 </a>
                    <a class="ar" title="Trang cuối" href="/product/item/index?page=6"><i
                            class="fa fa-fast-forward"></i></a></div>
            </div>

        </div>
        <div class="custome-paginate">
            <div class="pull-left">
                <p style="margin-top: 20px;">Hiển thị 1 - 20 / 20 records</p>
            </div>
            <div class="pull-right"></div>
        </div>
    </div>
</div>
