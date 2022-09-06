import ReportChartCareer from "./components/report_chart_career";
import ReportChartRank from "./components/report_chart_rank";
import ReportChartDegree from "./components/report_chart_degree";
import DateRangePicker from "../components/daterangepicker";

var active_scroll = true;
const ReportStaticChart = {
    init() {
        ReportChartRank.init();
        ReportChartDegree.init();
        ReportChartCareer.init();
        DateRangePicker.runDateRangeMonthPicker();
        this.filterChart();
        this.scrollReport();
        this.anchorReport();
    },

    filterChart() {
        $('#chart-filter-ajax').click(function () {
            let time = $('#chart-time-value').val();
            if (time) {
                let chart_rank = ReportChartRank.initChartReport(),
                    chart_degree = ReportChartDegree.initChartReport(),
                    chart_career = ReportChartCareer.initChartReport();
                chart_rank.destroy();
                chart_degree.destroy();
                chart_career.destroy();
                ReportChartRank.reportChartRank({'month_range': time});
                ReportChartDegree.reportChartDegree({'month_range': time});
                ReportChartCareer.reportChartCareer({'month_range': time});
            }
        });

        $('#reset-chart-filter').click(function () {
            $('#chart-time-value').val('')
            let chart_rank = ReportChartRank.initChartReport(),
                chart_degree = ReportChartDegree.initChartReport(),
                chart_career = ReportChartCareer.initChartReport();
            chart_rank.destroy();
            chart_degree.destroy();
            chart_career.destroy();
            ReportChartRank.reportChartRank({'month_range': null});
            ReportChartDegree.reportChartDegree({'month_range': null});
            ReportChartCareer.reportChartCareer({'month_range': null});
        });
    },

    scrollReport() {
        $(window).scroll(function () {
            let offsetTop = $(this).scrollTop()
            if (offsetTop >= 40) {
                $('.js-col-left').css('top', 0)
                $('.js-nav').css({
                    'marginTop': '15px'
                })
            } else {
                $('.js-col-left').css('top', '60px')
                $('.js-nav').css({
                    'marginTop': 0
                })
            }

            if (active_scroll) {
                $('.js-report').each(function (i) {
                    if ($(this).position().top <= offsetTop) {
                        $('.js-nav li.active').removeClass('active');
                        $('.js-nav li').eq(i).addClass('active');
                    }
                });
            }
        })
    },

    anchorReport() {
        $('.js-nav li a').click(function (e) {
            e.preventDefault();
            active_scroll = false;

            let $this = $(this),
                target = $($this.attr('href'));

            if (target.length) {
                $('.js-nav li').removeClass('active');
                $this.closest('li').addClass('active');
                let scrollTo = target.offset().top;
                $('body, html').animate({scrollTop: scrollTo + 'px'}, 500);

                setTimeout(() => {
                    active_scroll = true;
                }, 500)
            }
        });
    }
}

$(function () {
    ReportStaticChart.init();
})
