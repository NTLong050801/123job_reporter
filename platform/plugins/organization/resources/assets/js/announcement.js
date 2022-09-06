const Announcement = {
    init()
    {
        this.buildCkEditor();
    },

    buildCkEditor() {
        CKEDITOR.replace('announcement-content');
    },

}

$(document).ready(function () {
    Announcement.init();
})