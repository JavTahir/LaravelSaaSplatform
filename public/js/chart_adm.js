// Assuming chartData now has structure { labels: [...], datasets: [...] }


console.log(chartData.chartData.datasets[0].data);
new Chart("myChart", {
    type: "line",
    data: {
        labels: chartData.chartData.labels,
        datasets: [
            {
                data: chartData.chartData.datasets[0].data, // Users dataset (e.g., followers_count)
                borderColor: "#87CEFA",
                fill: false,
                label: "User Count",
            },
        ],
    },
    options: {
        legend: { display: true },
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                },
            },
            y: {
                beginAtZero: true,
            },
        },
    },
});
