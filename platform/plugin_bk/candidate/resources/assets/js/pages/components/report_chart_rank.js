import ApexCharts from "apexcharts";
import axios from "axios";

const ReportChartRank = {
    init() {
        this.reportChartRank();
    },

    reportChartRank(params = {}) {
        let chart = this.initChartReport();
        axios.get(URL_REPORT_RANK, {
            params: params
        }).then(res => {
            let data_reports = [],
                rank_reports = res.data.rank_reports,
                times = res.data.times;

            Object.values(rank_reports).forEach(item => {
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
            chart.updateOptions({
                series: data_reports,
                xaxis: {
                    categories: times
                }
            });
        }).catch(err => {
            console.log(err);
        });
    },

    initChartReport() {
        let options = {
            series: [],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            noData: {
                text: 'Vui lòng chờ trong giây lát...'
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [],
            },
            yaxis: {
                title: {
                    text: ''
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'right'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        };

        let chart = new ApexCharts(document.querySelector("#report-chart-level"), options);
        chart.render();
        return chart;
    },
}

export default ReportChartRank;