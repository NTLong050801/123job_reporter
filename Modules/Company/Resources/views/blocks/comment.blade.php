<script src="/libs/ckeditor/config.js"></script>
<style src="/libs/skins/moono/editor.css"></style>
<script type="text/javascript" src="/libs/ckeditor/lang/vi.js?t=E7KD"></script>
<script type="text/javascript" src="/libs/ckeditor/styles.js?t=E7KD"></script>
<script type="text/javascript" src="/libs/ckeditor/plugins/autolink/plugin.js?t=E7KD"></script>
<script type="text/javascript" src="/libs/ckeditor/plugins/link/dialogs/link.js?t=E7KD"></script>
<link rel="stylesheet" type="text/css" href="/libs/ckeditor/skins/moono/dialog.css?t=E7KD">
<style>
    .user-avatar img {
        width: 90%;
        height: 90%;
    }

    .comment {
        margin-bottom: 12px;
    }

    .comment .avatar-box {
        padding: 0px;
    }

    .comment .user-info {
        padding-left: 0px;
    }

    .comment .user-avatar {
        padding: 0px;
        text-align: center;
        border: 1px solid #ccc;
        height: 60px;
        display: block;
        font-size: 3em;
        overflow: hidden;
    }

    .comment .user-avatar image {
        width: 100%;
        height: 100%;
    }

    .comment .content-box {
        min-height: 80px;
        border: 1px solid #ccc;
        position: relative;
    }

    .comment .content-box .left-outline {
        background: none repeat scroll 0 0 #fff;
        border-bottom: 1px solid #d8d8d8;
        border-left: 1px solid #d8d8d8;
        height: 12px;
        left: -7px;
        position: absolute;
        top: 12px;
        transform: rotate(45deg);
        width: 12px;
    }

    .comment .content-box .content {
        padding: 5px;
        min-height: auto;
    }

    .tableContract tbody tr td {
        border: none !important;
    }

    .comment .content-box .action {
        position: absolute;
        right: 5px;
        top: 0;
    }
</style>

<div class="col-md-9" id="addCommentArea">
    <div class="col-md-2"></div>
    <div class="col-md-10">
          <textarea rows="8" cols="" class="basicEditor form-control" id="commentInput"></textarea>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-10" style="padding-top: 10px;">
        <a class="btn btn-primary" id="addComment">Thêm bình luận</a>
    </div>
</div>

<script src="/libs/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.env.isCompatible = true;
</script>

