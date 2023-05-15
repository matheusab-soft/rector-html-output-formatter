<?php

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rector Process Report</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/diff2html/bundles/css/diff2html.min.css"/>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/diff2html/bundles/js/diff2html-ui.min.js"></script>
    </head>
    <body>
        <div class="container-fluid my-5" style="max-width: 1920px;">
            <pre id="myDiffElement"></pre>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.code-diff-container').forEach(targetElement => {
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
                });
            </script>
            <div class="row">
                <div class="col-md-7">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3>Applied Rectors <small style="font-size: 13px;">(<?= count($diffOccurrences) ?>)</small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rector Class</th>
                                        <th>Occurrences</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($diffOccurrences as $diff => $occurrence): ?>
                                        <tr>
                                            <td><i><?= $diff ?></i></td>
                                            <td><?= $occurrence ?></td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h3>Affected Files <small style="font-size: 13px;">(<?= count($errorsJson['changed_files']) ?>)</small></h3></div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php
                                foreach ($errorsJson['changed_files'] as $changedFile): ?>
                                    <li class="list-group-item px-2 py-1"><?= $changedFile ?></li>
                                <?php
                                endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <h1>Changes by file</h1>
            <div class="card">
                <div class="card-body">
                    <?php
                    foreach ($errorsJson['file_diffs'] as $file): ?>
                        <div class="card mb-5">
                            <div class="card-header">
                                <h5><?= $file['file'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xxl-8">
                                        <div class="code-diff-container" data-content="<?= htmlentities($file['diff']) ?>">
                                            <code>
                                                <pre><?= htmlentities($file['diff']) ?></pre>
                                            </code>
                                        </div>
                                    </div>

                                    <div class="col-xxl-4">
                                        <h6 class="mt-xl-0 mt-lg-4">Applied Rectors</h6>
                                        <ul class="list-group">
                                            <?php
                                            foreach ($file['applied_rectors'] as $applied_rector): ?>
                                                <li class="list-group-item"><i><?= $applied_rector ?></i></li>
                                            <?php
                                            endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>

<style>
    [data-bs-theme="dark"] .d2h-info {
        background-color: #424242;
    }

    [data-bs-theme="dark"] .d2h-ins {
        background-color: #274427;
    }

    [data-bs-theme="dark"] .d2h-code-side-line del {
        background-color: #a74b50;
    }

    [data-bs-theme="dark"] .d2h-del {
        background-color: #4a2c2e;
        border-color: #7a4747;
    }

    [data-bs-theme="dark"] .d2h-code-side-emptyplaceholder, .d2h-emptyplaceholder {
        background-color: #222222;
        border-color: #2a2a2a;
    }

    [data-bs-theme="dark"] .d2h-code-side-line {
        color: #afafaf;
    }

    [data-bs-theme="dark"] .d2h-code-side-line ins {
        background-color: #337432;
    }

    [data-bs-theme="dark"] .d2h-code-side-linenumber {
        background-color: #343434;
        border: solid #363636;
        color: rgb(255 255 255 / 30%);
    }

    [data-bs-theme="dark"] .d2h-file-wrapper {
        border: 1px solid #444;
    }

    [data-bs-theme="dark"] .d2h-file-header {
        background-color: #242424;
        border-bottom: 1px solid #525252;
    }

    [data-bs-theme="dark"] .d2h-del {
        background-color: #4a2c2e;
    }
</style>