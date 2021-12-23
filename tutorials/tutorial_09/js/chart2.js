$(document).ready(function () {
    // Make an ajax call to server
    $.post("ajaxRes.php", function (data) {
        // Check response contain data
        if (data.status == 'No Data') {
            alert('No data fount');
        } else {
            var months = [];
            var count = [];
            for (var i in data) {
                months.push(data[i].created_at);
                count.push(data[i].count);
            }
            const ctx = document.getElementById('graphCanvasDate').getContext('2d');
            // Create chart by config
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Show Created by Month',
                        data: count,
                        backgroundColor: [
                            '#e68c8c',
                            '#e6966c',
                            '#b36a17',
                            '#d6bd58',
                            '#aac414',
                            '#278a06',
                            '#65e68c',
                            '#65e6c8',
                            '#4567c4',
                            '#701bd1',
                            '#e663ce',
                            '#c2082a'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: false,
                }
            });
        }
    });
});
