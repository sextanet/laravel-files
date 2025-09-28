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
use SextaNet\LaravelFiles\HasFiles; // 👈 1. Import

class YourModel extends Model
{
    use HasFiles; // 👈 2. Use it
}
```

We're ready! You can reuse it in each model, any times!

### Store

```php
$uploaded_file = request()->your_file;

$file = $user->addFile($uploaded_file); // using your default disk from config/filesystems.php
```

Or passing the name, for example: `new_name`, will preserve the extension, so, it will generate `new_name.mp4`

```php
$uploaded_file = request()->your_file; // let's supose you have "a_video.mp4"

$file = $user->addFile($uploaded_file, 'new_name'); // will generate new_name.mp4
```

### Get

You can get the `path`, `url` and `temporary_url` for each file

```php
$path = $file->path();

$url = $file->url();

$temporary_url = $file->temporaryUrl();
```

### Advanced usage

Passing a diffirent disk

```php
config(['files.disk' => 's3']);

$uploaded_file = request()->your_file;

$file = $user->addFile($uploaded_file, 'new_name'); // will upload into s3 disk
```

Passing custom minutes in each implementation

```php
$temporary_url = $file->getTemporaryUrl(20); // 20 minutes
```

Passing custom minutes globally

```php
config(['files.default_temporary_url_minutes' => 60]);

$temporary_url = $file->getTemporaryUrl(); // 60 minutes
```

### Passing types

Passing a type

```php
$uploaded_file = request()->your_file;

// Store
$user->addFile($uploaded_file, type: 'profile_photo');

// Get
$user->files()->type('image')->get();
```

### Custom keys

By default, it uses your CURRENT_DISK in your `.env` file. If you want to force to use different values, you can add these keys:

Another disk:

```dotenv
FILES_DISK=s3
```

Custom minutes:

```dotenv
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
