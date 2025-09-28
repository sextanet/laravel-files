# Laravel Files

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sextanet/laravel-files.svg?style=flat-square)](https://packagist.org/packages/sextanet/laravel-files)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sextanet/laravel-files/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sextanet/laravel-files/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sextanet/laravel-files/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sextanet/laravel-files/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sextanet/laravel-files.svg?style=flat-square)](https://packagist.org/packages/sextanet/laravel-files)

Upload seamless Storage and Database files in Laravel

## Installation

```bash
composer require sextanet/laravel-files
```

Publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-files-migrations"
php artisan migrate
```

## Usage

```php
class YourModel extends Model
{
    use HasFiles;
}
```

### Store

```php
$file = request()->your_file;

$user->addFile($file);
```

Or passing a specific disk `public`

```php
$file = request()->your_file;

$user->addFile($file, 'public');
```

### Get

You can get the `path`, `url` and `temporary_url` for each file

```php
$path = $file->getPath();

$url = $file->getUrl();

$temporary_url = $file->getTemporaryUrl(5); // 5 minutes

$temporary_url = $file->getTemporaryUrl(20); // 20 minutes
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
