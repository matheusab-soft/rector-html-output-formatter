<?php

use MAB\Rector\HtmlOutputFormatter;
use Rector\ChangesReporting\Contract\Output\OutputFormatterInterface;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->singleton(
        HtmlOutputFormatter::class,
        HtmlOutputFormatter::class
    );

    $rectorConfig->tag(
        HtmlOutputFormatter::class,
        OutputFormatterInterface::class
    );

    $rectorConfig
        ->when(HtmlOutputFormatter::class)
        ->needs('$exportedFilePathPrefix')
        ->give(__DIR__ . '/generated/custom-template-rector-report');

    $rectorConfig
        ->when(HtmlOutputFormatter::class)
        ->needs('$customReportTemplatePath')
        ->give(__DIR__ . '/custom_template.php');

    $rectorConfig->sets([
        \Rector\Set\ValueObject\SetList::DEAD_CODE,
        \Rector\Set\ValueObject\SetList::CODE_QUALITY,
        \Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_82,
    ]);

    $rectorConfig->paths([
        __DIR__ . '/test_src',
    ]);
};
