<div class="modal fade modal-candidate-detail" data-id="{{ $candidate->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px;">Thông tin chi tiết</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="font-weight: 600;">1. Thông tin cá nhân</h5>
                        <table class="table table-hover table-stripe table-bordered">
    {{--                            @if($candidate->feed_hash)--}}
    {{--                                <tr>--}}
    {{--                                    <th width="30%"><i class="fa fa-address-card"></i> Hồ sơ:</th>--}}
    {{--                                    <td><a href="{{ $candidate->feed_hash }}">{{ $candidate->feed_hash }}</a></td>--}}
    {{--                                </tr>--}}
    {{--                            @endif--}}
                            @if($candidate->feed_hash)
                                <tr>
                                    <th width="30%"><i class="fa fa-address-card"></i> Hồ sơ:</th>
                                    <td><a href="{{ config('url.feed') . 'detail/' . $candidate->feed_hash. '?open=1' }}" target="_blank">Xem hồ sơ</a></td>
                                </tr>
                            @endif
                            <tr>
                                <th width="30%"><i class="fa fa-star"></i> ID:</th>
                                <td>{{ $candidate->id }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-user"></i> Tên:</th>
                                <td>{{ $candidate->name }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-envelope-o"></i> Email:</th>
                                <td>{{ $candidate->email }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-phone"></i> Số điện thoại:</th>
                                <td>{{ $candidate->phone }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-map-marker"></i> Địa chỉ:</th>
                                <td>{{ $candidate->address }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-facebook-square"></i> Facebook:</th>
                                <td>{{ $candidate->meta_info['social']['facebook'] ?? '' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h5 style="font-weight: 600;">2. Thông tin thêm</h5>
                        <table class="table table-hover table-stripe table-bordered">
                            <tr>
                                <th width="30%"><i class="fa fa-briefcase"></i> Vị trí:</th>
                                <td>{{ $candidate->position }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-archive"></i> Ngành nghề:</th>
                                <td>{{ $candidate->career_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-universal-access"></i> Cấp bậc:</th>
                                <td>{{ $candidate->rank_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-transgender"></i> Giới tính:</th>
                                <td>{{ $candidate->gender_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-sitemap"></i> Loại hình làm việc:</th>
                                <td>{{ $candidate->work_type_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-clock-o"></i> Kinh nghiệm:</th>
                                <td>{{ $candidate->exp_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-calendar"></i> Ngày sinh:</th>
                                <td>{{ $candidate->birth_date }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-child"></i> Độ tuổi:</th>
                                <td>{{ $candidate->age_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-money"></i> Mức lương mong muốn:</th>
                                <td>{{ $candidate->salary_text }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-thumbs-o-up"></i> Kỹ năng:</th>
                                <td>{{ $candidate->skill }}</td>
                            </tr>
                            <tr>
                                <th width="30%"><i class="fa fa-hand-peace-o"></i> Giới thiệu:</th>
                                <td>{{ $candidate->intro }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="font-weight: 600;">3. Kinh nghiệm làm việc</h5>
                        <table class="table table-hover table-stripe table-bordered">
                            <tr>
                                <th width="30%">Ví trí</th>
                                <th width="70%">Công ty</th>
                            </tr>
                            @foreach($candidate->company as $item)
                                <tr>
                                    <td>{{ $item['position'] }}</td>
                                    <td>{{ $item['company'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h5 style="font-weight: 600;">4. Học vấn</h5>
                        <table class="table table-hover table-stripe table-bordered">
                            <tr>
                                <th width="30%">Chuyên ngành</th>
                                <th width="70%">Trường</th>
                            </tr>
                            @foreach($candidate->school as $item)
                                <tr>
                                    <td>{{ $item['majors'] ?: $item['cert'] ?? '' }}</td>
                                    <td>{{ $item['school'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
