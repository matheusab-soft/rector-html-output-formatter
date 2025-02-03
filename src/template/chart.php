<div class="col-xxl-4 col-xl-12">
    <div class="card mb-5">
        <div class="card-body">
            <div class="col">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        enableCodeDiffOn(document.querySelector('.tab-pane.active'))

        const chartEl = document.getElementById('chart');
        const labels = <?=json_encode($graphLabels);?>;
        const values = <?=json_encode($graphDiffOccurrences);?>;
        const colors = [
            '#118fff',
            '#36b9ff',
            '#3800ff',
            '#5319ff',
            '#4b7aff',
            '#d536c0',
            '#dd54ff',
            '#e5afff',
            '#16ffff',
            '#0b7562',
            '#005149',
            '#b55c39',
            '#ba775e',
            '#d3a698',
        ];
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Ocurrences',
                    data: values,
                    borderWidth: 1,
                    borderColor: 'transparent',
                    backgroundColor: colors
                }
            ]
        }
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    x: {
                        ticks: {
                            display: false,
                            z: 9999,
                            padding: -100
                        }
                    },
                },
                responsive: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                }
            },
        };

        new Chart(chartEl, config);
    });
</script>