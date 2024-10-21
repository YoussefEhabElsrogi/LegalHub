const ctx = document.getElementById("sessionsChart").getContext("2d");
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, "rgba(54, 162, 235, 1)");
gradient.addColorStop(1, "rgba(54, 162, 235, 0)");

const myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: monthNames.slice(0, currentMonth),
        datasets: [
            {
                label: "التغير في عدد الجلسات",
                data: changesPerMonth,
                borderColor: "rgba(54, 162, 235, 1)",
                backgroundColor: gradient,
                pointBackgroundColor: "#fff",
                pointBorderColor: "rgba(54, 162, 235, 1)",
                pointHoverBackgroundColor: "#ff6384",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointRadius: 5,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: "#000",
                    font: {
                        size: 18,
                    },
                },
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.dataset.label + ": " + context.parsed.y;
                    },
                },
                backgroundColor: "rgba(54, 162, 235, 0.8)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderWidth: 1,
                borderColor: "rgba(54, 162, 235, 1)",
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    color: "#000",
                    font: {
                        size: 20,
                    },
                },
            },
            y: {
                grid: {
                    borderDash: [5, 5],
                },
                ticks: {
                    color: "#000",
                    font: {
                        size: 18,
                    },
                },
            },
        },
    },
});

document.getElementById("download").addEventListener("click", function () {
    const link = document.createElement("a");
    link.href = document.getElementById("sessionsChart").toDataURL("image/png");
    link.download = "sessions-chart.png";
    link.click();
});
