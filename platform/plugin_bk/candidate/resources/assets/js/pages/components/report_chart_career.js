import ApexCharts from "apexcharts";
import axios from "axios";
import {changeAlias} from "../../../../../../../../resources/assets/js/helper";

const ReportChartCareer = {
    init() {
        this.reportChartCareer();
        this.reportCareerCheck();
        this.searchToggleCareer();
        this.resetChartCareer();
    },

    reportChartCareer(params = {}) {
        let chart_career = this.initChartReport();
        let arr_career = this.getArrayCareerChart();
        axios.get(URL_REPORT_CAREER, {
            params: $.extend(params, {careers_id: arr_career})
        }).then(res => {
            let data_reports = [],
                career_reports = res.data.career_reports,
                times = res.data.times;

            Object.values(career_reports).forEach(item => {
                let report_item = {
                    name: item.detail.name
                }
                let report_data = [];
                times.forEach(time => {
                    report_data.push(item.data[time]);
                });
                report_item.data = report_data;
                data_reports.push(report_item);
            })
            chart_career.updateOptions({
                series: data_reports,
                xaxis: {
                    categories: times
                }
            });
        }).catch(err => {
            console.log(err);
        });
    },

    reportCareerCheck() {
        $('.js-career-check').change(() => {
            let chart_career = this.initChartReport();
            chart_career.destroy();
            let time = $('#chart-time-value').val();
            this.reportChartCareer({'month_range': time});
        });
    },

    getArrayCareerChart() {
        let array_career_check = [];
        $('.js-career-check:checked').each(function () {
            array_career_check.push($(this).val());
        });
        return array_career_check;
    },

    resetChartCareer() {
        $('#reset-career-chart').click( () => {
            $('.js-career-check').prop('checked', false);
            let chart_career = this.initChartReport();
            chart_career.destroy();
            let time = $('#chart-time-value').val();
            this.reportChartCareer({'month_range': time});
        })
    },

    searchToggleCareer() {
        $('.js-search-career').keyup(function () {
            let searchText = changeAlias($(this).val().toLowerCase());
            $('.list-career label').each(function () {
                let text = changeAlias($(this).text().toLowerCase()),
                    show = text.indexOf(searchText) !== -1;
                $(this).toggle(show);
            });
        });
    },

    initChartReport() {
        let options = {
            series: [],
            chart: {
                height: 500,
                type: 'line',
                zoom: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            legend: {
                show: true,
                position: 'right',
            },
            noData: {
                text: 'Vui lòng chờ trong giây lát...'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: [],
            },
        };

        let chart = new ApexCharts(document.querySelector("#report-chart-career"), options);
        chart.render();
        return chart;
    },
}

export default ReportChartCareer;