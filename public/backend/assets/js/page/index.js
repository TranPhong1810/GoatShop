"use strict";

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            label: 'Sales',
            data: [3200, 1800, 4305, 3022, 6310, 5120, 5880, 6154, 7500, 0, 0, 0],
            borderWidth: 2,
            backgroundColor: 'rgba(63,82,227,.8)',
            borderWidth: 0,
            borderColor: 'transparent',
            pointBorderWidth: 0,
            pointRadius: 3.5,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
        },
        {
            label: 'Budget',
            data: [2207, 3403, 2200, 5025, 2302, 4208, 3880, 4880, 9000, 0, 0, 0],
            borderWidth: 2,
            backgroundColor: 'rgba(254,86,83,.7)',
            borderWidth: 0,
            borderColor: 'transparent',
            pointBorderWidth: 0,
            pointRadius: 3.5,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                gridLines: {
                    // display: false,
                    drawBorder: false,
                    color: '#f2f2f2',
                },
                ticks: {
                    beginAtZero: true,
                    stepSize: 1500,
                    callback: function (value, index, values) {
                        return '$' + value;
                    }
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                    tickMarkLength: 15,
                }
            }]
        },
    }
});

var sales_chart = document.getElementById("sales-chart").getContext('2d');
var salesData = salesData; // Giả sử salesData đã được định nghĩa ở đâu đó

var sales_chart_bg_color = sales_chart.createLinearGradient(100, 200, 80, 80);
sales_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
sales_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

var myChart = new Chart(sales_chart, {
    type: 'line',
    data: {
        labels: daysInMonth,
        datasets: [{
            label: 'Sales',
            data: salesData,
            borderWidth: 2,
            backgroundColor: sales_chart_bg_color,
            borderWidth: 3,
            borderColor: 'rgba(63,82,227,1)',
            pointBorderWidth: 0,
            pointBorderColor: 'transparent',
            pointRadius: 3,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(63,82,227,1)',
        }]
    },
    options: {
        layout: {
            padding: {
                bottom: -1,
                left: -1
            }
        },
        legend: {
            display: false
        },
        tooltips: {
            enabled: true,
            mode: 'index',
            intersect: false,
            bodyFontSize: 25, // Kích thước chữ trong tooltip
            titleFontSize: 28, // Kích thước chữ tiêu đề trong tooltip
            borderColor: 'rgba(63,82,227,1)', // Màu viền của tooltip
            borderWidth: 1,
            caretSize: 15, // Kích thước mũi nhọn của tooltip
        },
        scales: {
            yAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                ticks: {
                    beginAtZero: true,
                    display: false
                }
            }],
            xAxes: [{
                gridLines: {
                    drawBorder: false,
                    display: false,
                },
                ticks: {
                    display: false
                }
            }]
        },
    }
});


$("#products-carousel").owlCarousel({
    items: 3,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
    responsive: {
        0: {
            items: 2
        },
        768: {
            items: 2
        },
        1200: {
            items: 3
        }
    }
});
