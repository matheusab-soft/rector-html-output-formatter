<?php
/**
 * @var $errorsJson
 *      file_diffs: contains an array of files, like so: [
 *          file            : string
 *          diff            : string
 *          applied_rectors : string[]
 *      ]
 *      changed_files: string[]
 *
 * @var $diffOccurrences  array where:
 *  key: applied rector
 *  value: number of occurrences
 */

?>
<html>
    <body>
        <table>
            <?php foreach ($errorsJson['file_diffs'] as $file): ?>
            <tr>
                <td><?= $file['file'] ?></td>
                <td><?= htmlentities($file['diff']) ?></td>
                <td><?= implode('<br>', $file['applied_rectors']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <ul>
        <?php foreach ($diffOccurrences as $diff => $occurrences): ?>
            <li><?= $diff ?> - <?= $occurrences ?></li>
        <?php endforeach; ?>
        </ul>
    </body>
</html>