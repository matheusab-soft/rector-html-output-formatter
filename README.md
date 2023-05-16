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

----
Generated report example:
![image](https://github.com/matheusab-soft/rector-html-output-formatter/assets/3750530/6854d4c6-0f46-4ceb-a582-f3586c2e3bf9)
![image](https://github.com/matheusab-soft/rector-html-output-formatter/assets/3750530/7a410074-a7dd-4fc8-a67f-42d477cb37a3)
