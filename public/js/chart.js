// Assuming chartData is already defined
var chartOptions = {
    series: [
        {
            name: "Twitter Followers",
            data: chartData.chartData.datasets[0].data,
        },
        {
            name: "Linkedin Connections",
            data: chartData.chartData.datasets[1].data,
        },
    ],
    chart: {
        height: 400,
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
