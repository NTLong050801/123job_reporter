import Http from "Http/http.js";
import 'select2/dist/js/select2.min'
import { notify } from "Notify/notify";

var Permission = {
    init() {
        // this.runSelect2();
        this.collapseModule();
        this.permissionAssignRole();
        this.permissionAssignRole1();
    },
    runSelect2() {
        $(".select-user").select2({
            placeholder: "Chọn tài khoản"
        });
    },
    collapseModule() {
        $(".module").click(function() {
            let id = $(this).attr("data-id");
            $("tr[data-module=" + id + "]").fadeToggle(10);
        });
    },
    permissionAssignRole() {
        $("body").on("click", ".js-permission-assign-role", function() {
            let check = $(this).is(":checked") ? 1 : 0,
                parent_id = $(this).attr("data-permission");
            let role_id = $(this).attr("data-role");
            let child_list = $(
                "input[data-parent=" + parent_id + "][ data-role=" + role_id + "]"
            );
            if (check) {
                child_list.prop("checked", true);
            } else {
                child_list.prop("checked", false);
            }
            let permission = [parent_id];
            child_list.each(function() {
                permission.push($(this).data("permission") + "");
            });
            Permission.ajaxAssignRole(check, role_id, permission, URL_AJAX_PERMISSION_ASSIGN_ROLE);
        });
    },
    permissionAssignRole1() {
        $("body").on("click", ".js-permission-assign-role-1", function() {
            let check = $(this).is(":checked") ? 1 : 0,
                role_id = $(this).attr("data-role");
            let parent_id = $(this).attr("data-parent");
            let parent = $(
                "input[data-permission=" + parent_id + "][ data-role=" + role_id + "]"
            );
            let child_list = $(
                "input[data-parent=" + parent_id + "][ data-role=" + role_id + "]"
            );
            let d = 0;
            for (let i = 0; i < child_list.length; i++) {
                if (child_list[i].checked) {
                    d++;
                }
            }
            let permission = [];
            if (check) {
                parent.prop("checked", true);
                if (d <= 1) {
                    permission.push(parent_id);
                    permission.push($(this).attr("data-permission"));
                } else {
                    permission.push($(this).attr("data-permission"));
                }
            } else {
                if (d == 0) {
                    parent.prop("checked", false);
                    permission.push(parent_id);
                    permission.push($(this).attr("data-permission"));
                } else {
                    permission.push($(this).attr("data-permission"));
                }
            }
            Permission.ajaxAssignRole(check, role_id, permission, URL_AJAX_PERMISSION_ASSIGN_ROLE);
        });
    },
    ajaxAssignRole(check, id, permission, url) {
        let data = {
            check,
            id,
            permission,
            _token: token
        };
        var token = $('meta[name="csrf-token"]').attr("content");
        Http.post({
                url: url,
                data: {
                    check,
                    id,
                    permission,
                    _token: token
                },
                beforeSend: function() {
                    // Http.loading();
                }
            })
            .done(function(data) {
                if (data.success) {
                    notify(data.success, "success");
                } else {
                    notify(data.error, "error");
                }
            })
            .fail(function(error) {
                notify("Có lỗi xảy ra, vui lòng thử lại sau", "error");
            })
            .always(function() {
                Http.done();
            });
    }
};
$(function() {
    Permission.init();
});