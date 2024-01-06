// Assuming chartData is already defined
var chartOptions = {
    series: [
        {
            name: "Users Count",
            data: chartData.chartData.datasets[0].data,
        },
    ],
    chart: {
        height: 350,
        type: "area",
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
    },
    xaxis: {
        categories: chartData.chartData.labels,
    },
    legend: {
        show: true,
    },
    toolbar: {
        show: false,
    },
};

var chart = new ApexCharts(document.querySelector("#myChart"), chartOptions);
chart.render();
