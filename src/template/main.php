<?php

$currentDate = date('M d Y, H:i:s', time());
$graphLabels = array_keys($diffOccurrences);
$graphDiffOccurrences = array_values($diffOccurrences);

function getShortClassName($fqn)
{
    $rectorClassName = explode('\\', $fqn);
    return $rectorClassName[count($rectorClassName) - 1];
}

function htmlAppliedRector($fqn)
{
    $shortClassName = getShortClassName($fqn);
    return "<pre class='m-0'><code title='$fqn'>$shortClassName</code></pre>";
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
            <?php include 'style.css'?>
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Rector HTML Report</a> <small>Generated at <?= $currentDate ?></small>
            </div>
        </nav>

        <div class="container-fluid my-3">
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


            </script>

            <?php
            include 'overview/main.php' ?>


            <?php
            include 'changes_by_file/main.php' ?>

        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"
        ></script>
        <?php
        include 'footer.php';
        ?>

    </body>
</html>