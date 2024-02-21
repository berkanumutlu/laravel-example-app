$(document).ready(function () {
    "use strict";

    var options1 = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded',
                borderRadius: 10
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
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            labels: {
                style: {
                    colors: 'rgba(94, 96, 110, .5)'
                }
            }
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        },
        grid: {
            borderColor: '#e2e6e9',
            strokeDashArray: 4
        }
    }
    var chart1 = new ApexCharts(document.querySelector("#apex-earnings"), options1);
    chart1.render();

    var options2 = {
        chart: {
            id: 'sparkline1',
            type: 'area',
            height: 80,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            opacity: 1,
        },
        series: [{
            name: 'Sales',
            data: [14, 40, 35, 20, 50, 25, 49]
        }],
        labels: [1, 2, 3, 4, 5, 6, 7],
        yaxis: {
            min: 0,
            max: 60
        },
        colors: ['#FFDDB8']
    }
    var chart2 = new ApexCharts(document.querySelector("#widget-stats-chart1"), options2);
    chart2.render();

    var options3 = {
        chart: {
            id: 'sparkline3',
            type: 'area',
            height: 80,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            opacity: 1,
        },
        series: [{
            name: 'Sales',
            data: [50, 20, 50, 40, 55, 15, 58]
        }],
        labels: [1, 2, 3, 4, 5, 6, 7],
        yaxis: {
            min: 0,
            max: 60
        },
        colors: ['#ffccce']
    }
    var chart3 = new ApexCharts(document.querySelector("#widget-stats-chart2"), options3);
    chart3.render();

    var options4 = {
        chart: {
            id: 'sparkline1',
            type: 'area',
            height: 80,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            opacity: 1,
        },
        series: [{
            name: 'Sales',
            data: [40, 15, 55, 32, 20, 50, 41]
        }],
        labels: [1, 2, 3, 4, 5, 6, 7],
        yaxis: {
            min: 0,
            max: 60
        },
        colors: ['#DCE6EC']
    }
    var chart4 = new ApexCharts(document.querySelector("#widget-stats-chart3"), options4);
    chart4.render();

    let chart_most_popular_articles = new Chart(document.getElementById("chartjs-most-popular-articles"), {
        "type": "bar",
        "data": {
            "labels": mostPopularArticlesChartDataLabels,
            "datasets": [
                {
                    "label": mostPopularArticlesChartDatasetLabel,
                    "data": mostPopularArticlesChartDatasetData,
                    "fill": false,
                    "backgroundColor": [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(201, 203, 207, 0.2)"
                    ],
                    "borderColor": [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)"
                    ],
                    "borderWidth": 1
                }
            ]
        },
        "options": {
            "scales": {
                "yAxes": [
                    {
                        "ticks":
                            {
                                "beginAtZero": true
                            }
                    }]
            }
        }
    });
    let chart_category_articles = new Chart(document.getElementById("chartjs-category_articles"), {
        "type": "bar",
        "data": {
            "labels": categoryArticlesChartDataLabels,
            "datasets": [
                {
                    "label": categoryArticlesChartDatasetLabel,
                    "data": categoryArticlesChartDatasetData,
                    "fill": false,
                    "backgroundColor": [
                        "rgba(81, 157, 233, 0.2)",
                        "rgba(124, 198, 116, 0.2)",
                        "rgba(163, 0, 0, 0.2)",
                        "rgba(239, 146, 52, 0.2)",
                        "rgba(132, 129, 221, 0.2)",
                        "rgba(166, 166, 166, 0.2)",
                        "rgba(115, 197, 197, 0.2)",
                        "rgba(246, 209, 115, 0.2)"
                    ],
                    "borderColor": [
                        "rgb(81, 157, 233)",
                        "rgb(124, 198, 116)",
                        "rgb(163, 0, 0)",
                        "rgb(239, 146, 52)",
                        "rgb(132, 129, 221)",
                        "rgb(166, 166, 166)",
                        "rgb(115, 197, 197)",
                        "rgb(246, 209, 115)"
                    ],
                    "borderWidth": 1
                }
            ]
        },
        "options": {
            "scales": {
                "yAxes": [
                    {
                        "ticks":
                            {
                                "beginAtZero": true
                            }
                    }]
            }
        }
    });
});
