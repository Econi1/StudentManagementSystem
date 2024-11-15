$(document).ready(function () {
    // Load Chart.js charts
    loadCharts();
    
    function loadCharts() {
        // Students Chart
        var ctx1 = document.getElementById('studentsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['DCOM', 'DBS', 'TECH', 'ECD', 'DIT'],
                datasets: [{
                    label: 'Number of Students',
                    data: [26, 36, 80, 45, 47],
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Instructors Chart
        var ctx2 = document.getElementById('instructorsChart').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['DCOM', 'TECH', 'ECD', 'DBS', 'DT'],
                datasets: [{
                    label: 'Number of Instructors',
                    data: [5, 10, 8, 15, 9],
                    backgroundColor: 'rgba(40, 167, 69, 0.5)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Courses Chart
        var ctx3 = document.getElementById('coursesChart').getContext('2d');
        new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['NCCM', 'DIT', 'DCS', 'NCICT','NCEI','NCAF','NCAM','NCPL','NCBP','ECD','NCTFD',''],
                datasets: [{
                    label: 'Courses Distribution',
                    data: [20, 5, 3, 5,30,15,18,6,8,34,13],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(100, 120, 11, 0.6)',
                        'rgba(25, 199, 130, 0.6)',
                        'rgba(00, 206, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(100, 120, 11, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    }
});
