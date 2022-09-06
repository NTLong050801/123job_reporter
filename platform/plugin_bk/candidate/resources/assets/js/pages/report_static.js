import DateRangePicker from "../components/daterangepicker";
import 'datatables';

const ReportStatic = {
  init() {
    DateRangePicker.runDateRangeMonthPicker();
    this.sortDataTable();
    this.sortDataTableClick();
    this.tableFixed();
  },

  tableFixed() {
    $(window).scroll(function () {
      let offsetTop   = $(this).scrollTop(),
          $table      = $('.table-career'),
          tableOffset = $table.offset().top;
      if (offsetTop >= tableOffset) {
        $table.addClass('fixed');
      } else {
        $table.removeClass('fixed');
      }
    });
    $(".table-responsive tbody").scroll(function () {
      $(".table-responsive thead").scrollLeft($(".table-responsive tbody").scrollLeft());
    });
  },

  sortDataTable() {
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
      "formatted-num-pre": function (a) {
        a = a.toString().replace(/\./g, '');
        return parseInt(a);
      },
    });
    $('#sort-table').DataTable({
      paginate: false,
      searching: false,
      // dom: '<"top"i>rt<"bottom"flp><"clear">',
      columnDefs: [
        {type: 'formatted-num', orderSequence: ["desc", "asc"], targets: '_all'}
      ]
    })
  },

  sortDataTableClick() {
    $('#sort-table').on('click', 'thead th[aria-controls="sort-table"]', function () {
      $('table.dataTable thead th[aria-controls="sort-table"]').css('backgroundImage', 'url("../../../images/sort_both.png")');
      $('table.dataTable thead .sorting_asc').css('backgroundImage', 'url("../../../images/sort_asc.png")');
      $('table.dataTable thead .sorting_desc').css('backgroundImage', 'url("../../../images/sort_desc.png")');
      $('table.dataTable thead .sorting_asc_disabled').css('backgroundImage', 'url("../../../images/sort_asc_disabled.png")');
      $('table.dataTable thead .sorting_desc_disabled').css('backgroundImage', 'url("../../../images/sort_desc_disabled.png")');
    });
    $('table.dataTable thead .sorting').css('backgroundImage', 'url("../../../images/sort_both.png")');
  },
}

$(function () {
  ReportStatic.init();
})
