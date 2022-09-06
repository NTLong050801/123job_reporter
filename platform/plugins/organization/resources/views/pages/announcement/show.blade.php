@extends('company::layouts.master')
@section('title', "Danh sách thông báo")
@section('css')
    <script src="{{ asset("libs/ckeditor/ckeditor.js") }}"></script>
    <style>
        #content img{
            max-width: 100%;
        }
    </style>
@endsection
@section('content')
    {{ Breadcrumbs::render('announcement::show') }}
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-9 col-lg-9">
                <div class="main-header">
                    <h3 style="margin-top: 0" class="text-danger">{{ $item->name }}</h3>
                    <em class="text-danger">Tạo bởi: {{ $item->admin->name }} - {{ date_format(date_create($item->created_at),"d-m-Y H:i:s") }}</em>
                    @if ($item->must_read)
                        <p class="text-danger" style="color: red">
                            (<i class="fa fa-exclamation-triangle"></i>Thông báo bắt buộc phải đọc )
                        </p>
                    @endif
                </div>

                <div id="content" style="margin-top: 15px">
                    {!! $item->content !!}
                </div>

                <div class="col-md-12 no-padding">
                    <h4 class="text-danger">File đính kèm</h4>
                    <div class="col-md-12 no-padding" id="currentContainer" style="margin-top: 15px;">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Tên file</th>
                                    <th class="text-center">Người tạo</th>
                                    <th class="text-center">Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($item->medias())
                                    @foreach($item->medias() as $key => $file)
                                        <tr>
                                            <td width="1%" align="center">{{ $key + 1 }}</td>
                                            <td>{{ $file->md_origin_name }}</td>
                                            <td width="20%">{{ $file->admin->name }}</td>
                                            <td width="1%" align="center">
                                                <a href="{{parse_url_file($file->md_name, 'upload_files')}}" download>
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12 no-padding" id="comments">
                    <h4 class="text-danger">Nhận xét</h4>
                    <div id="commentTask">
                        <ul class="lst-comment"></ul>
                    </div>

                    <div id="commentForms" class="col-md-12 no-padding">
                        <textarea name="content" id="comment-input" style="min-height: 120px;"></textarea>
                    </div>
                    <input name="submit" type="button" id="btnSaveCrmContact" class="btn btn-primary submit-comment" style="margin-top:20px" value="Bình luận">
                </div>
            </div>

            <div class="col-sm-3 sideBarAnnouncement">
                @if ($list_birth_day->count())
                <h4 class="titleAnnouncement">Sinh nhật sắp tới</h4>
                <ul class="lst-birthday no-padding" style="list-style: none">
                    @foreach($list_birth_day as $admin)
                        <li data-toggle="tooltip" data-title="{{ $admin->department->name }}" style="margin-top: 8px">
                            <i data-toggle="tooltip" data-title="{{ date_format( date_create($admin->date_of_birth),"d-m-Y") }}"
                               class="fa fa-birthday-cake"></i> ({{ date_format( date_create($admin->date_of_birth),"d/m") }}) {{$admin->name}}
                        </li>
                    @endforeach
                </ul>
                @endif

                <h4 class="titleAnnouncement">Thông báo mới</h4>
                <ol class="announcements">
                    @foreach($new_items as $new_item)
                        <li>
                            <a href="{{ route('get.announcement.show', $new_item->id) }}">{{ $new_item->name }}</a>
                        </li>
                    @endforeach
                </ol>
                <style>
                    .announcements{
                        padding: 0 0 0 20px;
                    }
                    .announcements li{
                        margin: 10px 0;
                    }
                    .announcements li a{
                        color: #666;
                        font-size: 12px;
                    }
                    .titleAnnouncement{
                        border-bottom: 1px solid #ab1d1d;
                        padding: 0 0 5px 0;
                        font-size: 13px;
                        text-transform: uppercase;
                        font-weight: 700;
                    }
                </style>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        CKEDITOR.replace( 'comment-input', {
            toolbar: [
                { name: 'basicstyles', items: ['TextColor', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat', 'Link', 'Unlink'] }
            ]
        });
    </script>
@stop
