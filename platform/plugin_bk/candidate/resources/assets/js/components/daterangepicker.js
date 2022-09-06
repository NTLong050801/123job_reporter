import "knockout-daterangepicker/dist/daterangepicker.min";
import moment from "moment/moment";

const DateRangePicker = {
    runDateRangePicker() {
        $('input[name="date_range"]').daterangepicker({
            forceUpdate: false,
            periods: ['day'],
            locale: {
                inputFormat: 'MM/DD/YYYY',
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month').add(1, 'days'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month').add(1, 'days'), moment().subtract(1, 'month').endOf('month')],
                'Custom Range': 'custom'
            }
        }, function (startDate, endDate, period) {
            $(this).val(startDate.format('L') + ' – ' + endDate.format('L'))
        });
    },

    runDateRangeMonthPicker() {
        $('input[name="month_range"]').daterangepicker({
            minDate: [moment().subtract(3, 'years')],
            // startDate: moment().subtract(1, 'years'),
            // endDate: moment(),
            locale: {
                inputFormat: 'MM/YYYY',
            },
            periods: ['month'],
            expanded: true,
            ranges: {},
        }, function (startDate, endDate, period) {
            $(this).val(startDate.format('MM/YYYY') + ' – ' + endDate.format('MM/YYYY'))
        });
    }
}

export default DateRangePicker;