<?php

$pageSize = 10;
$chunks = array_chunk($errorsJson['file_diffs'], $pageSize);
$totalFilesChanged = count($errorsJson['file_diffs']);
?>

<div class="row mt-5">
    <h1 id="changes-by-file-title">Changes by file</h1>
</div>

<div class="card" id="changes-by-file">
    <div class="card-body">
        <div class="tab-content">
            <div class="pagination-feedback text-cener text-muted mb-4"></div>
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
                        include 'card.php';
                    endforeach;
                    ?>
                </div>

            <?php
            endforeach; ?>
            <div class="pagination-feedback text-cener text-muted mt-4"></div>
        </div>
    </div>
</div>

<nav class="container mt-4" aria-label="Affected files diff pagination">
    <ul class="pagination pagination-lg justify-content-center flex-wrap">
        <?php
        for ($i = 0; $i < count($chunks); $i++): ?>
            <li class="page-item <?= $i === 0 ? 'active' : ''; ?>" role="presentation">
                <a
                    href="#changes-by-file-title"
                    data-target="#files-page-<?= $i ?>"
                    class="page-link"
                    data-page-number="<?= $i + 1 ?>"
                ><?= $i + 1 ?></a>
            </li>
        <?php
        endfor; ?>
    </ul>
</nav>


<input type="hidden" id="totalFilesChanged" value="<?= $totalFilesChanged ?>"/>

<input type="hidden" id="pageSize" value="<?= $pageSize ?>"/>

<script>
    const totalFilesChanged = document.getElementById('totalFilesChanged').value
    const pageSize = document.getElementById('pageSize').value;

    document.querySelectorAll('.page-link').forEach(el => el.addEventListener('click', onClickPageLink))

    function onClickPageLink(e) {
        const
            a = e.currentTarget,
            li = a.parentElement,
            targetPaneId = a.dataset['target'],
            pageNumber = a.dataset['pageNumber'],
            targetPane = document.querySelector(targetPaneId)

        e.preventDefault();
        updatePaginationFeedback(pageNumber)
        document.querySelector('.page-item.active')?.classList.remove('active');
        document.querySelector('.tab-pane.active')?.classList.remove('active');
        li.classList.add('active');

        targetPane.classList.add('active')
        enableCodeDiffOn(targetPane)
    }

    function updatePaginationFeedback(page1Indexed) {
        const
            subsetStart = (page1Indexed - 1) * pageSize + 1,
            subsetEnd = Math.min(page1Indexed * pageSize, totalFilesChanged),
            paginationFeedback = `Showing files ${subsetStart}-${subsetEnd} of ${totalFilesChanged}`

        document.querySelectorAll('.pagination-feedback').forEach(el => el.innerHTML = paginationFeedback)

    }

    updatePaginationFeedback(1)


</script>