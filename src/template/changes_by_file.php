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
                            <div
                                class="code-diff-container" data-content="<?= htmlentities($file['diff']) ?>"
                            >
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