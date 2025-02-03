<?php

$diff = htmlentities($file['diff']);
?>

<div class="card mb-5">
    <div class="card-header">
        <h5><code><?= $file['file'] ?></code></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xxl-3">
                <h6 class="mt-xl-0 mt-lg-3 text-uppercase">Applied Rectors</h6>
                <ul class="list-group">
                    <?php
                    foreach ($file['applied_rectors'] as $fqn): ?>
                        <li class="list-group-item"><?= htmlAppliedRector($fqn) ?></li>
                    <?php
                    endforeach ?>
                </ul>
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
</div>