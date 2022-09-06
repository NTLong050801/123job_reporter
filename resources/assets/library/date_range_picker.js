import "../plugins/daterangepicker/daterangepicker.min";
import moment from "moment/moment";
moment.locale('vi');

const DateRangePicker = {
    runDateRangePicker()
    {
        $('input[name="date_range"]').daterangepicker({
            forceUpdate: false,
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    })
        .on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    },

    runDateRangeMonthPicker() {
        $('input[name="month_range"]').daterangepicker({
            showDropdowns: true,
            format: 'MM/YYYY',
            viewMode: "months",
            minViewMode: "months"
        }, function (startDate, endDate, period) {
            $(this).val(startDate.format('MM/YYYY') + ' - ' + endDate.format('MM/YYYY'))
        });
    }
};

export default DateRangePicker;