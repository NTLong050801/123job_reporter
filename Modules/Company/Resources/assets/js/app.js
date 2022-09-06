import 'bootstrap3/dist/js/bootstrap.min'
import 'admin-lte/dist/js/adminlte.min'
import './plugins/notify.min';

var App = {
    init() {
        this.activeMenu();
    },
    activeMenu() {
        let $dom = $('.treeview-menu').find('li.active');
        $dom.closest(".li-parent").addClass('active menu-open')
    },

};

$(function() {
    App.init();
});