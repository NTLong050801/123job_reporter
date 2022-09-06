import {GoogleCharts} from "google-charts";

const JS_UPLOAD_PUBLIC = {
    init() {
        this.handleDataChart()
    },

    handleDataChart() {
        GoogleCharts.load(drawChart)

        function drawChart() {
            $('.chart-item').each(function () {
                let $domChart =  $(this).find('.chart')[0];

                let  site_id = $(this).find('.chart').attr('data-id');
                let  day   = $('.js-day').val();

                var dataChart = new google.visualization.DataTable();
                var request = $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: URL_SHOW_SEO_CONTENT,
                    data : {
                        site_id : site_id,
                        day : day
                    }
                });

                request.done(function (response) {
                    let data = response.data;
                    $.each(data.columns, function (index, value) {
                        dataChart.addColumn(value.type, value.name);
                    });
                    $.each(data.rows, function (index, value) {
                       value[0] = new Date(value[0]);
                    });
                    let rows = [];
                    data.rows.forEach((value) => {
                        var thisRow = []
                        value.forEach((val, key) => {

                            var dateFormat = new Date(data.rows[0][0]);

                            if (dateFormat=== 'object') {
                                thisRow.push({
                                    v: new Date(val),
                                    f: new Date(val).toLocaleString('vi-VN',{ year: "numeric", month: "short", day: "numeric"})
                                });
                            } else if (data.columns[key].type === 'number') {
                                thisRow.push({
                                    v: parseFloat(val),
                                });
                            } else {
                                thisRow.push({
                                    v: val,
                                });
                            }

                        })
                        rows.push(thisRow);
                    })
                    dataChart.addRows(rows)
                    let LineChart = new google.visualization.ChartWrapper({
                        'chartType': 'LineChart',
                        'containerId': $domChart,
                        'dataTable': dataChart,
                                'options': Object.assign({},{"titleTextStyle":{"fontSize":14},
                                        "titlePosition":"out","focusTarget":"category",
                                        "legend":{"position":"top"},
                                        "tooltip":{"textStyle":{"fontName":"Roboto", "fontSize":14}},
                                        "pointShape":"circle","pointSize":4,
                                        "hAxis":{"format":"dd MMM"},
                                        "vAxis":{"format":"short"},"lineWidth":2,"chartArea":{"width":"90%","height":"84%","top":"10%","left":"8%"}},
                                    {
                                        "height":240,

                                        "hAxis":{"format":"dd MMM","gridlines":{"count":8} },
                                        "vAxis":{ "gridlines":{"count":4},"format":"short"},
                                        "chartArea":{"width":"90%","height":"83%","top":"7%","left":"8%"},
                                        "series":[]},


                        ),
                        'view': {
                            'columns': [...data.columns.keys()]
                        }
                    });

                    LineChart.draw();
                })
            })
        }
    }
}

$(function () {
    JS_UPLOAD_PUBLIC.init()
})
