<div class="col-xxl-4 col-xl-7">
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="d-flex">
                <span class="flex-grow-1">Applied Rectors</span>

                <span class="badge rounded-pill bg-primary"><?= count($diffOccurrences) ?></span>
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive mh-100">
                <table class="table table-striped sticky-header mh-100">
                    <thead>
                        <tr>
                            <th>Rector Class</th>
                            <th>Occurrences</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($diffOccurrences as $fqn => $occurrence): ?>
                            <tr>
                                <td><?= htmlAppliedRector($fqn) ?></td>
                                <td><?= $occurrence ?></td>
                            </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>