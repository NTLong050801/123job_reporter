import Http from "Http/http.js";
import 'select2/dist/js/select2.min'
import { notify } from "Notify/notify";

var Role = {
    init() {
        this.runSelect2();
        this.roleAssignAdmin();
    },
    runSelect2() {
        $(".select-user").select2({
            placeholder: 'Chọn tên user',
        });
    },
    roleAssignAdmin()
    {
        $('body').on('click', '.js-role-assign-admin', function () {
            let check = $(this).is(":checked") ? 1 : 0,
                admin_id = $(this).attr('data-admin'),
                role_id = $(this).attr('data-role');
            Http.post({
                url : URL_AJAX_ROLE_ASSIGN_ADMIN,
                data : { check : check, admin_id : admin_id, role_id : role_id },
                beforeSend : function () {
                    Http.loading();
                }
            }).done(function (data) {
                console.log(data);
                if(data.success)
                {
                    notify(data.success, 'success');
                }
                else {
                    notify(data.error, 'error');
                }
            }).fail(function (error) {
                console.log(error);
                notify('Có lỗi xảy ra, vui lòng thử lại sau', 'error');
            }).always(function () {
                Http.done();
            });
        });
    }
};
$(function () {
    Role.init();
});