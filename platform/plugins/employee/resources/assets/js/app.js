import 'jquery-modal';
const Role = {
    init() {
        this.selectRole();
    },
    selectRole() {
        $('.fa-eye').on('click', function() {
            $(this).prev().attr('type', $(this).prev().attr('type') === 'password' ? 'text' : 'password');
        });
    }
};

$(function() {
    Role.init();
});
