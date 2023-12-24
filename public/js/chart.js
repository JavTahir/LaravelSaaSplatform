const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
];

const xValues = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

new Chart("myChart", {
    type: "line",
    data: {
        labels: months,
        datasets: [
            {
                data: [
                    860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478,
                ],
                borderColor: "#FFB6C1",
                fill: false,
                label: "Facebook",
            },
            {
                data: [
                    1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000,
                ],
                borderColor: "#98FB98",
                fill: false,
                label: "Instagram",
            },
            {
                data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                borderColor: "#87CEFA",
                fill: false,
                label: "Twitter",
            },
            {
                data: [400, 900, 1200, 1600, 300, 2400, 2800, 3200, 3600, 4000],
                borderColor: "rgba(255, 218, 8, 0.816)",
                fill: false,
                label: "LinkedIn",
            },
        ],
    },
    options: {
        legend: { display: false },
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
