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

    $rectorConfig->when(HtmlOutputFormatter::class)
        ->needs('$exportedFilePathPrefix')
        ->give(__DIR__ . '/generated/rector-report');

    //for testing reasons
    $rectorConfig->when(HtmlOutputFormatter::class)
        ->needs('$testGenerationDate')
        ->give(date('M d Y, H:i:s', 730080000));

    $rectorConfig->sets([
        \Rector\Set\ValueObject\SetList::DEAD_CODE,
        \Rector\Set\ValueObject\SetList::CODE_QUALITY,
        \Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_82,
    ]);

    $rectorConfig->paths([
        __DIR__ . '/test_src',
    ]);
};
