import Http from "Http/http.js";
import 'select2/dist/js/select2.min'
import { notify } from "Notify/notify";
import { defaultsDeep } from "lodash";

var Permission = {
    init() {
        this.runSelect2();
        this.collapseModule();
        this.permissionAssignAdmin();
        this.permissionAssignAdmin1();
    },
    runSelect2() {
        $(".select-user").select2({
            placeholder: "Chọn tên user"
        });
    },
    collapseModule() {
        $(".module").click(function() {
            let id = $(this).attr("data-id");
            $("tr[data-module=" + id + "]").fadeToggle(10);
        });
    },
    permissionAssignAdmin() {
        $("body").on("click", ".js-permission-assign-admin", function(e) {
            // e.preventDefault();
            let parentId = $(this).attr("data-parent");
            let check = $(this).is(":checked") ? 1 : 0;
            let parent = $("input[data-permission=" + parentId + "]");
            let childList = $("input[data-parent=" + parentId + "]");
            let d = 0;
            for (let i = 0; i < childList.length; i++) {
                if (childList[i].checked) {
                    d++;
                }
            }
            let permission = [];
            if (check) {
                parent.prop("checked", true);
                if (d <= 1) {
                    permission.push(parentId);
                    permission.push($(this).attr("data-permission"));
                } else {
                    permission.push($(this).attr("data-permission"));
                }
            } else {
                if (d == 0) {
                    parent.prop("checked", false);
                    permission.push(parentId);
                    permission.push($(this).attr("data-permission"));
                } else {
                    permission.push($(this).attr("data-permission"));
                }
            }
            let admin_id = $(this).attr("data-admin");
            Permission.ajaxAssignRole(check, admin_id, permission, URL_AJAX_PERMISSION_ASSIGN_ADMIN);
        });
    },
    permissionAssignAdmin1() {
        $("body").on("click", ".js-permission-assign-admin-1", function() {
            let parentId = $(this).attr("data-permission");
            let check = $(this).is(":checked") ? 1 : 0;
            let child = $("input[data-parent=" + parentId + "]");
            if (check) {
                child.prop("checked", true);
            } else {
                child.prop("checked", false);
            }
            let permission = [parentId];
            child.each(function() {
                permission.push($(this).data("permission") + "");
            });
            let admin_id = $(this).attr("data-admin");
            Permission.ajaxAssignRole(check, admin_id, permission, URL_AJAX_PERMISSION_ASSIGN_ADMIN);
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