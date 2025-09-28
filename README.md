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
    use HasFiles; // Use in each model as you need
}
```

### Store

```php
$uploaded_file = request()->your_file;

$file = $user->addFile($uploaded_file); // using your default disk from config/filesystems.php
```

Or passing a specific disk, for example: `public`

```php
$uploaded_file = request()->your_file;

$file = $user->addFile($uploaded_file, 'public');
```

### Get

You can get the `path`, `url` and `temporary_url` for each file

```php
$path = $file->getPath();

$url = $file->getUrl();

$temporary_url = $file->getTemporaryUrl();
```

### Advanced usage

Passing custom minutes in each implementation

```php
$temporary_url = $file->getTemporaryUrl(20); // 20 minutes
```

Passing custom minutes globally

```php
config(['files.default_temporary_url_minutes' => 60]);

$temporary_url = $file->getTemporaryUrl(); // 60 minutes
```

### .env
```dotenv
FILES_TABLE=files
FILES_DISK=local
FILES_TEMPORARY_URL_MINUTES=5
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
