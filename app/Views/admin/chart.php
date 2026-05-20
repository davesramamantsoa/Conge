<?php echo view('admin/_header', ['title' => 'Chart', 'active' => 'chart']); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histogramme Chart.js</title>

    <script src=<?= base_url("assets/bootstrap/js/chart.js") ?>></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        canvas {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="card p-3 shadow">
            <h5>Statistiques mensuelles</h5>
            <canvas id="salesChartMonth"></canvas>
        </div>
        <div class="card p-3 shadow">
            <h5>Statistiques journalières</h5>
            <canvas id="salesChartDay"></canvas>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('salesChartMonth');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode([
                            'Janvier',
                            'Février',
                            'Mars',
                            'Avril',
                            'Mai',
                            'Juin',
                            'Juillet',
                            'Août',
                            'Septembre',
                            'Octobre',
                            'Novembre',
                            'Décembre'
                        ]) ?>,

                datasets: [{
                    label: 'Congés',
                    data: <?= json_encode(array_column($allMonthData, 'total')) ?>,
                    backgroundColor: '#3498db',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script>
        const ctx1 = document.getElementById('salesChartDay');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?= json_encode([
                            'Lundi',
                            'Mardi',
                            'Mercredi',
                            'Jeudi',
                            'Vendredi',
                            'Samedi',
                            'Dimanche'
                        ]) ?>,

                datasets: [{
                    label: 'Congés',
                    data: <?= json_encode(array_column($allWeekData, 'total')) ?>,
                    backgroundColor: '#2ecc71',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

<?php echo view('admin/_footer'); ?>

</html>