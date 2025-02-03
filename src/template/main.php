<?php

//$maxVisibleGraphLabels = 20;
//$graphLabels = array_keys(array_slice($diffOccurrences, 0, $maxVisibleGraphLabels));
//$graphLabels[] = sprintf("Other (%s rectors)", count($diffOccurrences) - $maxVisibleGraphLabels);
$graphLabels = array_keys($diffOccurrences);

//$graphDiffOccurrences = array_values(array_slice($diffOccurrences, 0, $maxVisibleGraphLabels));
//$graphDiffOccurrences[] = array_sum(array_slice($diffOccurrences, $maxVisibleGraphLabels))
$graphDiffOccurrences = array_values($diffOccurrences);

function getShortClassName($fqn)
{
    $rectorClassName = explode('\\', $fqn);
    return $rectorClassName[count($rectorClassName) - 1];
}

function htmlAppliedRector($fqn)
{
    $shortClassName = getShortClassName($fqn);
    return "<i title='$fqn'>$shortClassName</i>";
}

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rector Process Report</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
            crossorigin="anonymous"
        >
        <link
            rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/diff2html/bundles/css/diff2html.min.css"
        />
        <script
            type="text/javascript" src="https://cdn.jsdelivr.net/npm/diff2html/bundles/js/diff2html-ui.min.js"
        ></script>

        <style>
            <?include 'style.css';?>
        </style>
    </head>
    <body>
        <div class="container-fluid my-5">
            <pre id="myDiffElement"></pre>
            <script>

                /**
                 * @param {Element} containerEl
                 */
                function enableCodeDiffOn(containerEl) {
                    containerEl.querySelectorAll('.code-diff-container').forEach(targetElement => {
                        const diffString = targetElement.dataset.content
                        var configuration = {
                            drawFileList: false,
                            fileListToggle: false,
                            fileListStartVisible: false,
                            fileContentToggle: false,
                            matching: 'lines',
                            outputFormat: 'side-by-side',
                            highlightLanguages: ['php'],
                            languages: 'php',
                            language: 'php',
                            synchronisedScroll: true,
                            highlight: true,
                        };
                        var diff2htmlUi = new Diff2HtmlUI(targetElement, diffString, configuration);
                        diff2htmlUi.draw();
                        diff2htmlUi.highlightCode();
                    })
                }

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
            <div class="row" id="stats-row">
                <?php
                include __DIR__ . '/chart.php' ?>

                <?php
                include __DIR__ . '/applied_rectors.php' ?>

                <?php
                include __DIR__ . '/affected_files.php' ?>
            </div>


            <?php
            include __DIR__ . '/changes_by_file.php'
            ?>

        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>
</html>