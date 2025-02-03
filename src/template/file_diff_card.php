<?php

$diff = htmlentities($file['diff']);
?>

<div class="card mb-5">
    <div class="card-header">
        <h5><code><?= $file['file'] ?></code></h5>
    </div>
    <div class="row p-0">
        <div class="col-xxl-3 pe-0">
            <div class="p-2 pe-0">
                <h6 class="mt-xl-0 mt-lg-3 text-uppercase">Applied Rectors</h6>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($file['applied_rectors'] as $fqn): ?>
                        <li class="list-group-item"><?= htmlAppliedRector($fqn) ?></li>
                    <?php
                    endforeach ?>
                </ul>
            </div>
        </div>

        <div class="col-xxl-9">
            <div class="code-diff-container" data-content="<?= $diff ?>">
                <code>
                    <pre><?= $diff ?></pre>
                </code>
            </div>
        </div>

    </div>
</div>