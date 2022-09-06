import DateRangePicker from "assets/library/date_range_picker.js";

var ReferSite = {
    init: function () {
        this.__initDatePicker();
    },
    __initDatePicker()
    {
        DateRangePicker.runDateRangePicker();
        DateRangePicker.runDateRangeMonthPicker();
    }
};

$(function () {
    ReferSite.init();
});