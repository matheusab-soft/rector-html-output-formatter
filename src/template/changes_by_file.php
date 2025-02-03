<?php

$chunks = array_chunk($errorsJson['file_diffs'], 10);
?>

<div class="row mt-5">
    <h1 id="changes-by-file-title">Changes by file</h1>
</div>

<div class="card" id="changes-by-file">
    <div class="card-body">
        <div class="tab-content">
            <?php
            foreach ($chunks as $i => $chunk): ?>

                <div
                    id="files-page-<?= $i ?>"
                    class="tab-pane <?= $i === 0 ? 'active' : '' ?>"
                    role="tabpanel"
                    tabindex="0"
                >
                    <?php
                    foreach ($chunk as $file):
                        include 'file_diff_card.php';
                    endforeach;
                    ?>
                </div>

            <?php
            endforeach; ?>
        </div>
    </div>
</div>

<nav class="container mt-4" aria-label="Affected files diff pagination">
    <ul class="pagination pagination-lg justify-content-center flex-wrap">
        <?php
        for ($i = 0; $i < count($chunks); $i++): ?>
            <li class="page-item <?= $i === 0 ? 'active' : ''; ?>" role="presentation">
                <a
                    href="#changes-by-file-title" data-target="#files-page-<?= $i ?>" class="page-link"
                ><?= $i + 1 ?></a>
            </li>
        <?php
        endfor; ?>
    </ul>
</nav>


<script>
    document.querySelectorAll('.page-link').forEach(el => el.addEventListener('click', onClickPageLink))

    function onClickPageLink(e) {
        const a = e.currentTarget
        const li = a.parentElement;
        e.preventDefault();
        // renderItems(i);
        document.querySelector('.page-item.active')?.classList.remove('active');
        document.querySelector('.tab-pane.active')?.classList.remove('active');
        li.classList.add('active');
        const targetPaneId = a.dataset['target']
        const targetPane = document.querySelector(targetPaneId)
        targetPane.classList.add('active')
        enableCodeDiffOn(targetPane)
    }
</script>