document.addEventListener("DOMContentLoaded", function () {
    const ctx1 = document.getElementById("myChart1").getContext("2d");

    const myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: ["แดง", "น้ำเงิน", "เขียว", "เหลือง"],
            datasets: [
                {
                    label: "คะแนน",
                    data: [12, 19, 3, 5],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.5)",
                        "rgba(54, 162, 235, 0.5)",
                        "rgba(75, 192, 192, 0.5)",
                        "rgba(255, 206, 86, 0.5)",
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(255, 206, 86, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    const ctx2 = document.getElementById("myChart2").getContext("2d");

    const myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: ["แดง", "น้ำเงิน", "เขียว", "เหลือง"],
            datasets: [
                {
                    label: "คะแนน",
                    data: [7, 14, 10, 6],
                    backgroundColor: [
                        "rgba(255, 159, 64, 0.5)",
                        "rgba(153, 102, 255, 0.5)",
                        "rgba(255, 205, 86, 0.5)",
                        "rgba(201, 203, 207, 0.5)",
                    ],
                    borderColor: [
                        "rgba(255, 159, 64, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 205, 86, 1)",
                        "rgba(201, 203, 207, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});
