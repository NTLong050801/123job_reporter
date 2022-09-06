import 'resources_assets/plugins/jquery_ui.min.js';
import { notify } from "resources_assets/js/notify.js";

var Module = {
    init() {
        this.selectMenu();
        this.initModule();
    },
    initModule() {
        $(document).ready(function() {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('ul.mainlist').sortable({

                connectWith: 'ul.mainlist',
                update: function(event, ui) {
                    var arr1 = $(this).sortable('toArray', { attribute: 'data-id' });
                    var filtered = arr1.filter(function(el) {
                        return el != '';
                    });
                    $.ajax({
                            url: URL_AJAX_MODULE,
                            type: 'POST',
                            data: {
                                _token: token,
                                obj: filtered,
                            }

                        }).done(function(data) {
                            if (data.success) {
                                notify(data.success, "success");
                            } else {
                                notify(data.error, "error");
                            }
                        })
                        .fail(function(res) {
                            notify("Có lỗi xảy ra, vui lòng thử lại sau", "error");
                        });
                }
            });

            $("ul.sublist").sortable({
                connectWith: 'ul.sublist',
                update: function(event, ui) {
                    var sort = $(this).sortable('toArray', { attribute: 'data-id' });
                    $.ajax({
                            url: URL_AJAX_MODULE,
                            type: 'POST',
                            data: {
                                _token: token,
                                obj: sort,
                            },
                        }).done(function(data) {
                            if (data.success) {
                                notify(data.success, "success");
                            } else {
                                notify(data.error, "error");
                            }
                        })
                        .fail(function(res) {
                            notify("Có lỗi xảy ra, vui lòng thử lại sau", "error");
                        });
                }
            });

        });
    },
    selectMenu() {
        $(".menu-list li").on("click", function() {
            let menu_id = $(this).attr("id");
            $(".menu-list li").removeClass('select');
            $(this).addClass('select');
            $.ajax({
                url: 'sort-data/' + menu_id,
                type: "GET",
            }).done(function(response) {
                var li = `<ul id="list1" class='mainlist'>
                `;
                response.forEach(el => {
                    if (el["parent_id"] == 0) {
                        li =
                            li +
                            `<li class="li1 id="set_${el["id"]}" data-id="${el["id"]}">
                                <div class="div1 ">
                                    <div class="width1 text-bold">${el["title"]}</div>
                                    <div class="width2"></div>
                                    <div class="width3"></div>
                                </div>
                                <ul class="sublist">`;
                        response.forEach(el1 => {
                            if (el1["parent_id"] == el["id"]) {
                                li =
                                    li +
                                    `
                                    <li class="li2 " id="set_${el1["id"]}" data-id="${el1["id"]}">
                                        <div class="div1">
                                            <div class="width1">${el1["title"]}</div>
                                            <div class="width2">${el1["name"]}</div>
                                            <div class="width3">${el1["uri"]}</div>
                                        </div>
                                    </li>`;
                            }
                        });

                        li = li + ` </ul>
                        </li>`;
                    }
                });
                $(".sort").html(li);
                Module.initModule();
            });
        });
    }
};
$(function() {
    Module.init();
});
