<div class="col-xl-6 mb-3">
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="d-flex">
                <span class="flex-grow-1">Applied Rectors</span>

                <span class="badge rounded-pill bg-primary"><?= count($diffOccurrences) ?></span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                include 'chart.php'; ?>

                <?php
                include 'applied_rectors_content.php'; ?>

            </div>
        </div>
    </div>
</div>