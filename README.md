# Install
`composer require --dev matheusab/rector-html-output-formatter`

# Usage

Configure it in your `rector.php`, where the `exportedFilePathPrefix` argument is the path to the exported report.
Example:

```php
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->singleton(HtmlOutputFormatter::class, HtmlOutputFormatter::class);
    $rectorConfig->tag(HtmlOutputFormatter::class, OutputFormatterInterface::class);
    $rectorConfig
        ->when(HtmlOutputFormatter::class)
        ->needs('$exportedFilePathPrefix')
        ->give(__DIR__ . '/rector-report');
```

> Since v1.1, a custom report template can also be used:
> see [Using a custom report template](#using-a-custom-report-template)

# Generating a report

After configuring it, you can generate it with Rector's `process` command by setting `--output-format=html`.

Example:

```
vendor/bin/rector process --dry-run --output-format=html
```

# Using a custom report template

When configuring `RectorConfig`, a custom report template can be used. Example:

`rector.php`:

```php
$rectorConfig
    ->when(HtmlOutputFormatter::class)
    ->needs('$customReportTemplatePath')
    ->give(__DIR__ . '/custom_template.php');
```

You may use the following variables on the template:

| Variable           | Description                                                                                                                                                                                                                           |
|--------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$errorsJson`      | an array with the following keys:<br/>`changed_files`: an array of file names<br/> `file_diffs`: an array of files with the following shape:<br/> * `'file => string`<br/>* `'diff' => string` <br/>* `'applied_rectors' => string[]` | 
| `$diffOccurrences` | a map where <br/>`key`: applied rector <br/>`value`: number of occurences                                                                                                                                                             |

## Examples

* [Default template](src/report-template.php)
* [A simple template used for testing purposes](tests/custom_template.php)

# Generated report screenshots

![image](https://github.com/matheusab-soft/rector-html-output-formatter/assets/3750530/6854d4c6-0f46-4ceb-a582-f3586c2e3bf9)
![image](https://github.com/matheusab-soft/rector-html-output-formatter/assets/3750530/7a410074-a7dd-4fc8-a67f-42d477cb37a3)
