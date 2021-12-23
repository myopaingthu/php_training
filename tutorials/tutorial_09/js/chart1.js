$(document).ready(function () {
    // Make an ajax call to server
    $.post("ajaxResponse.php", function (data) {
        // Check response contain data
        if (data.status == 'No Data') {
            alert('No data found');
        } else {
            var names = [];
            var ages = [];
            for (var i in data) {
                names.push(data[i].name);
                ages.push(data[i].age);
            }
            const ctx = document.getElementById('graphCanvas').getContext('2d');
            // Create chart by config
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: names,
                    datasets: [{
                        label: 'Ages',
                        data: ages,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        hoverBackgroundColor: '#CCCCCC',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });
        }
    });
});
