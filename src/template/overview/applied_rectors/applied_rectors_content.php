<div class="col-8">
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
                        <td>
                            <span class="badge rounded-pill">
                            <?= $occurrence ?>
                            </span>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>