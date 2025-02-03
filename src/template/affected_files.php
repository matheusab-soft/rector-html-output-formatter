<div class="col-xxl-4 col-md-5">
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
                    <li class="list-group-item px-2 py-1"><?= $changedFile ?></li>
                <?php
                endforeach; ?>
            </ul>
        </div>
    </div>
</div>