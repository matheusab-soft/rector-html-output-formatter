<?php

declare (strict_types=1);

namespace MAB\Rector;

use Rector\ChangesReporting\Annotation\RectorsChangelogResolver;
use Rector\ChangesReporting\Contract\Output\OutputFormatterInterface;
use Rector\ValueObject\Configuration;
use Rector\ValueObject\Error\SystemError;
use Rector\ValueObject\ProcessResult;

;
use Rector\Parallel\ValueObject\Bridge;

use function count;
use function ksort;

final class HtmlOutputFormatter implements OutputFormatterInterface
{

    /**
     * @var string
     */
    public const NAME = 'html';

    /** @var string */
    private $exportedFilePathPrefix;

    public function __construct(string $exportedFilePathPrefix)
    {
        $this->exportedFilePathPrefix = $exportedFilePathPrefix;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function report(ProcessResult $processResult, Configuration $configuration): void
    {
        $errorsJson = [
            'totals' => [
                'changed_files' => count($processResult->getFileDiffs()),
            ],
        ];

        $fileDiffs = $processResult->getFileDiffs();
        ksort($fileDiffs);

        $header = "--- Original\n+++ New\n";

        foreach ($fileDiffs as $fileDiff) {
            $relativeFilePath = $fileDiff->getRelativeFilePath();
            $newHeader = "--- $relativeFilePath\n+++ $relativeFilePath\n";

            $errorsJson[Bridge::FILE_DIFFS][] = [
                'file' => $relativeFilePath,
                'diff' => str_replace($header, $newHeader, $fileDiff->getDiff()),
                'applied_rectors' => $fileDiff->getRectorClasses(),
            ];
            // for Rector CI
            $errorsJson['changed_files'][] = $relativeFilePath;
        }
        $errors = $processResult->getSystemErrors();
        $errorsJson['totals']['errors'] = count($errors);
        $errorsData = $this->createErrorsData($errors);
        if ($errorsData !== []) {
            $errorsJson['errors'] = $errorsData;
        }

        file_put_contents($this->exportedFilePathPrefix . '-report.html', self::getGeneratedHTML($errorsJson));
        file_put_contents(
            $this->exportedFilePathPrefix . '-data.php',
            '<?php return ' . var_export($errorsJson, true) . ';'
        );
        echo 'Report generated at rector-report.html';
    }

    /**
     * @param SystemError[] $errors
     *
     * @return mixed[]
     */
    private function createErrorsData(array $errors): array
    {
        $errorsData = [];
        foreach ($errors as $error) {
            $errorDataJson = [
                'message' => $error->getMessage(),
                'file' => $error->getRelativeFilePath(),
            ];

            if ($error->getRectorClass() !== null) {
                $errorDataJson['caused_by'] = $error->getRectorClass();
            }
            if ($error->getLine() !== null) {
                $errorDataJson['line'] = $error->getLine();
            }
            $errorsData[] = $errorDataJson;
        }
        return $errorsData;
    }

    public static function getGeneratedHTML(array $errorsJson): string
    {
        $template = __DIR__ . '/report-template.php';

        return self::render($template, [
            'errorsJson' => $errorsJson,
            'diffOccurrences' => self::getDiffOcurrences($errorsJson),
        ]);
    }

    private static function getDiffOcurrences(array $errorsJson): array
    {
        $diffOcurrences = [];
        foreach ($errorsJson[Bridge::FILE_DIFFS] as $file_diff) {
            foreach ($file_diff['applied_rectors'] as $rector) {
                if (!isset($diffOcurrences[$rector])) {
                    $diffOcurrences[$rector] = 0;
                }
                $diffOcurrences[$rector]++;
            }
        }
        arsort($diffOcurrences);
        return $diffOcurrences;
    }

    public static function render($file, $params)
    {
        if (is_file($file)) {
            ob_start();
            extract($params);
            include($file);
            $content = ob_get_contents();
            ob_end_clean();
        } else {
            throw new \RuntimeException(sprintf('Cant find view file %s!', $file));
        }

        return $content;
    }

}