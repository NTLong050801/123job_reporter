@if (count($messages))
    <div class="row">
        <div class="col-md-12">
            @foreach ($messages as $message)
                <div class="alert alert-dismissible  alert-{{ $message['level'] }}">
                    <i class="fa fa-bell"></i> Thông báo: {!! $message['message'] !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endif
