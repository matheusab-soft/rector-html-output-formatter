<div class="col-xl-6 col-md-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h3 class="d-flex">
                <span class="flex-grow-1">Affected Files</span>

                <span class="badge rounded-pill bg-primary"><?= count($errorsJson['changed_files']) ?></span>
            </h3>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <?php
                foreach ($errorsJson['changed_files'] as $changedFile): ?>
                    <li class="list-group-item px-2 py-1"><code><?= $changedFile ?></code></li>
                <?php
                endforeach; ?>
            </ul>
        </div>
    </div>
</div>