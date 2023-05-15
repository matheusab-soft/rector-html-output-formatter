# Usage
Configure it in your `rector.php`, where the `exportedFilePathPrefix` argument is the path to the exported report.
Example:

```php
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->services()
        ->set(HtmlOutputFormatter::class)
        ->arg('$exportedFilePathPrefix', __DIR__ . '/rector-report')
        ->autowire()
        ->autoconfigure();
```


After configuring it, you can generate it with Rector's `process` command by setting `--output-format=html`. 

Example:
```
endor/bin/rector process --dry-run --output-format=html
