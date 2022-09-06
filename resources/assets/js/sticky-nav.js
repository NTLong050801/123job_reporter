const Sticky = {
    init() {
        this.sticky();
    },
    sticky() {
        let stickyMenu = "<div class='head-fixed' style='position:fixed; margin-right:15px; z-index:1000; top:0;width:" + ($('.table-scroll').width() + 2) + "px'><table class='table table-fixed table-bordered table-hover' ></table></div>";
        if ($("a[data-toggle=tab]").length == 0) {
            let thead = $('.table-scroll thead').clone();
            $(stickyMenu).insertBefore($('.table-scroll'));
            $(window).scroll(function (e) {
                var offset = $(".table-scroll").offset();
                if (offset) {
                    let top = offset.top - $(window).scrollTop();
                    if (top < 0) {
                        $('.head-fixed .table').prepend(thead);
                        $('.head-fixed').removeClass('hide');
                    }
                    if (top >= 0) {
                        $('.head-fixed').addClass('hide');
                    }
                }
            })
        }
        else {
            let tab = $('.nav-tabs .active ');
            let tab_id = tab.children('a').attr('href');
            Sticky.sticky_tab(tab_id);
            $('.nav-tabs li').click(function(e){
                let tab_id= $(this).children('a').attr('href');
                $(tab_id).find('.head-fixed').remove();
                Sticky.sticky_tab(tab_id);
            })
        }
    },
    sticky_tab(tab_id) {
        let stickyMenu = "<div class='head-fixed' style='position:fixed; margin-right:15px; z-index:1000; top:0;width:" + ($('.content').width()) + "px'><table class='table table-fixed table-bordered table-hover' ></table></div>";
        let thead = $(tab_id).find('.table-scroll thead:first').clone();
        let table = $(tab_id).find('.table-scroll');
        $(stickyMenu).insertBefore(table);
        $(window).scroll(function (e) {
            var offset = $(tab_id).find(".table-scroll").offset();
            if (offset) {
                let top = offset.top - $(window).scrollTop();
                if (top < 0) {
                    $(tab_id).find('.head-fixed .table').prepend(thead);
                    $(tab_id).find('.head-fixed thead').not(':first').remove();
                    $(tab_id).find('.head-fixed').removeClass('hide');
                }
                if (top >= 0) {
                    $(tab_id).find('.head-fixed').addClass('hide');
                    $(tab_id).find('.head-fixed thead').not(':first').remove();
                }
            }
        })
        thead.remove();
    }

}
$(function () {
    Sticky.init();
})