import 'select2/dist/js/select2.full.min';
import 'bootstrap/js/src/modal'
import DateRangePicker from "../components/daterangepicker";
import Http from "../../../../../../../Modules/Company/Resources/assets/js/helpers/http";

const ReportCV = {
  init() {
    DateRangePicker.runDateRangeMonthPicker();
    this.runSelect2();
    this.viewDetailCandidate();
  },
  runSelect2() {
    $(".select2").select2();
  },
  viewDetailCandidate() {
    $('.js-candidate-detail').on('click', function (e) {
      e.preventDefault();
      let $this        = $(this),
          id           = $this.data('id'),
          $modalDetail = $('.modal-candidate-detail[data-id=' + id + ']');
      if ($modalDetail.length > 0) {
        $modalDetail.modal('show');
      } else {
        let ajax = Http.get({
          url: window._candidate.url_detail,
          data: {
            id: id
          },
          beforeSend: function () {
            // Http.loading();
          }
        });
        ajax.done(function (data) {
          $(data.html).appendTo('body');
          $('body .modal-candidate-detail[data-id=' + id + ']').modal('show');
        });
        ajax.always(function () {
          Http.done();
        });
      }
    });
  },
}
$(function () {
  ReportCV.init();
})
