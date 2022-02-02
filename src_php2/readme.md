# Coding challenge task

## Requirements

* Mandatory: `php` v8.0+
* Optional (only for short console commands): `composer`
* Optional (only for integration tests): `bash`

## Install

* Optional: set URL or local file name to `$filename` in `run.php`
* Optional: set "ReaderJson" ot "ReaderXml" to `$reader` in `run.php`

## Run

* `php run.php CLASS [PARAM1] [PARAM2]`, where:
  * Mandatory "CLASS" is a class name in folder `controllers/`. For example: "CountByVendorId" or "count_by_vendor_id"
  * Optional "PARAM1", "PARAM2" are parameters for this class.
* or `composer run count_by_price_range` or `composer run count_by_vendor_id` - some pre-defined command

## Integration tests

* `tests/run.sh` or `composer run test`. It should be "+" and should not be "-"
