<?php $currentPage = 'calendrier';
$pageTitle = 'Mon calendrier'; ?>
<?php include 'header.php'; ?>

<div class="header mb-3">
    <h1><i class="bi bi-calendar-check"></i> Mon calendrier de congés</h1>
</div>

<div class="card">
    <div class="card-body p-3">
        <div id="calendar"></div>
    </div>
</div>
<script src=<?= base_url("assets/bootstrap/js/index.global.min.js") ?>></script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

            events: <?= json_encode(array_map(function ($c) {
                        return [
                            'title' => $c['motif'] ?? '',
                            'start' => $c['date_debut'] ?? null,
                            'end'   => date('Y-m-d', strtotime($c['date_fin'] . ' +1 day'))
                        ];
                    }, is_array($allConge) ? $allConge : []), JSON_UNESCAPED_UNICODE) ?>
            });

            calendar.render();
        });
    </script>


<?php include 'footer.php'; ?>