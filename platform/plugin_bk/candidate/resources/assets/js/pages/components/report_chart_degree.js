import ApexCharts from "apexcharts";
import axios from "axios";

const ReportChartDegree = {
    init() {
        this.reportChartDegree();
    },

    reportChartDegree(params = {}) {
        let chart = this.initChartReport();
        axios.get(URL_REPORT_DEGREE, {
            params: params
        }).then(res => {
            let data_degrees = [],
                degree_reports = res.data.degree_reports,
                times = res.data.times;

            Object.values(degree_reports).forEach(item => {
                let degree_item = {
                    name: item.detail.name
                }
                let report_data = [];
                times.forEach(time => {
                    report_data.push(item.data[time]);
                });
                degree_item.data = report_data;
                data_degrees.push(degree_item);
            })

            chart.updateOptions({
                series: data_degrees,
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
            noData: {
                text: 'Vui lòng chờ trong giây lát...'
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

        let chart = new ApexCharts(document.querySelector("#report-chart-education"), options);
        chart.render();
        return chart;
    },
}

export default ReportChartDegree;