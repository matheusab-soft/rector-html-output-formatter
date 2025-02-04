# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.4.0
### Changed
- Default template:
  - Improved UI performance for default report template (added pagination)
  - Added 'Ocurrences' X 'Used Rectors' chart
  

## 1.3.0
### Changed
- Report is no longer generated if there are no errors to be fixed

### Fixed
- Generated file path in command output

## 1.2
### Added
- Support to rector v2

## 1.19
### Added
- A custom report template can now be provided by injecting the `$customReportTemplatePath` variable.
 
## 1.0
### Changed
- Minimum Rector version is now 1.0

## 0.4
### Changed
- Restrict version constraint to due to RectorsChangelogResolver class being removed on rector:1.2.0 (see https://github.com/matheusab-soft/rector-html-output-formatter/issues/5)

## 0.3
### Changed
- Update minimum php requirement from 7 to 7.2 to match Rector
- Minimum Rector version is now 0.19 

## 0.2
### Added
- Support for php8
### Changed
- Example code now uses Laravel service container interface instead of Symfony
