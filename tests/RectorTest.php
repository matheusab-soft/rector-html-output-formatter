<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class RectorTest extends TestCase {

    protected function setUp(): void {
        parent::setUp(); // TODO: Change the autogenerated stub
        @unlink(__DIR__ . '/generated/rector-report-data.php');
        @unlink(__DIR__ . '/generated/rector-report-report.html');
    }

    public function testTerminalCommandGeneratedHtmlReport(): void {
        $dataFile = __DIR__ . '/generated/rector-report-data.php';
        $reportFile = __DIR__ . '/generated/rector-report-report.html';
        $expectedCommandResult = 'Report generated at rector-report.html';
        $expectedReportContent = file_get_contents(__DIR__ . '/expected-rector-report-report.html');

        $this->assertFileDoesNotExist($dataFile);
        $this->assertFileDoesNotExist($reportFile);

        $rectorBin = realpath(__DIR__ . '/../vendor/bin/rector');
        $testSrcPath = realpath(__DIR__ . '/test_src');
        $command = "../vendor/bin/rector process $testSrcPath --dry-run --output-format=html";
        echo "Command: $command";
        $commandResult = shell_exec($command);
        echo $commandResult;
        $actualReportContent = file_get_contents($reportFile);

        $this->assertEquals($expectedCommandResult, $commandResult);
        $this->assertFileExists($dataFile);
        $this->assertFileExists($reportFile);
        $this->assertEquals($expectedReportContent, $actualReportContent);
    }

}