@extends('company::layouts.master')
@section('title', "Report site apply")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('apply-job-attribute') }}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="form-search pull-left fFilterC">
                            <form action="" method="get" class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="date_range" autocomplete="off"
                                           placeholder="Chọn thời gian" value="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                                    </button>
                                    <a href="" class="btn btn-default">Làm mới</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-hover table-bordered table-scroll">
                            <thead>
                            <tr>
                                <th width="1%" class="text-center">STT</th>
                                <th width="15%">WEBSITE</th>

                                <th width="4%" class="text-center">10/06</th>
                                <th width="4%" class="text-center">09/06</th>
                                <th width="4%" class="text-center">08/06</th>
                                <th width="4%" class="text-center">07/06</th>
                                <th width="4%" class="text-center">06/06</th>
                                <th width="4%" class="text-center">05/06</th>
                                <th width="4%" class="text-center">04/06</th>
                                <th width="4%" class="text-center">03/06</th>
                                <th width="4%" class="text-center">02/06</th>
                                <th width="4%" class="text-center">01/06</th>
                                <th width="4%" class="text-center">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">65</td>
                                <td>Xuất - Nhập khẩu</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>8</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">44</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">66</td>
                                <td>Khách sạn - Nhà hàng</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">44</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">67</td>
                                <td>Chứng khoán - Vàng</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>8</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">44</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">68</td>
                                <td>Freelance</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">44</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">69</td>
                                <td>Thương mại điện tử</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>0</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">43</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">70</td>
                                <td>Y tế - Dược</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">43</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">71</td>
                                <td>Biên tập/ Báo chí/ Truyền hình</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">43</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">72</td>
                                <td>Thể dục/ Thể thao</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">43</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">73</td>
                                <td>Bảo hiểm/ Tư vấn bảo hiểm</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>8</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">42</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">74</td>
                                <td>Trắc Địa / Địa Chất</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">42</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">75</td>
                                <td>Dịch vụ</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">41</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">76</td>
                                <td>Bán hàng</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>8</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">41</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">77</td>
                                <td>In ấn - Xuất bản</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>8</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">41</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">78</td>
                                <td>Biên dịch/Phiên dịch</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">40</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">79</td>
                                <td>Nhân viên trông quán internet</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">39</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">80</td>
                                <td>Thủ công mỹ nghệ</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>8</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">38</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">81</td>
                                <td>Cơ khí - Chế tạo</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">36</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">82</td>
                                <td>Lương cao</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>0</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">36</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">83</td>
                                <td>Thư ký - Trợ lý</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">35</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">84</td>
                                <td>Xuất khẩu lao động</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>7</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">34</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">85</td>
                                <td>Quan hệ đối ngoại</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>6</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">33</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">86</td>
                                <td>Kế toán - Kiểm toán</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">32</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">87</td>
                                <td>Tư vấn/ Chăm sóc khách hàng</td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>0</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>0</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>2</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>3</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>1</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>4</u></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-primary"><u>5</u></a>
                                </td>
                                <td align="center">
                                    <a href="" class="text-primary">25</a>
                                </td>
                            </tr>

                            <tr class="bg-gray-light">
                                <td align="center"><b>TỔNG</b></td>
                                <td></td>
                                <td align="center"><b>392</b></td>
                                <td align="center"><b>436</b></td>
                                <td align="center"><b>442</b></td>
                                <td align="center"><b>376</b></td>
                                <td align="center"><b>378</b></td>
                                <td align="center"><b>366</b></td>
                                <td align="center"><b>404</b></td>
                                <td align="center"><b>404</b></td>
                                <td align="center"><b>434</b></td>
                                <td align="center"><b>454</b></td>
                                <td align="center"><b>4086</b></td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="pull-right">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    {!! script_src('/js/refer-site.js', '/vendor/reference-site') !!}
@endsection

