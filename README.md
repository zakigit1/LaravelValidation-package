# Laravel Lang Publisher

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bousbaadev/lang-publisher.svg?style=flat-square)](https://packagist.org/packages/bousbaadev/lang-publisher)
[![Total Downloads](https://img.shields.io/packagist/dt/bousbaadev/lang-publisher.svg?style=flat-square)](https://packagist.org/packages/bousbaadev/lang-publisher)
[![License](https://img.shields.io/packagist/l/bousbaadev/lang-publisher.svg?style=flat-square)](https://packagist.org/packages/bousbaadev/lang-publisher)

A Laravel package that automatically publishes language folders and adds Arabic (ar) and French (fr) validation translations. Compatible with all Laravel versions including Laravel 10+ where the lang directory is at the root level.

## Features

- Automatically detects and adapts to your Laravel version's language folder structure
- Publishes language files if they haven't been published yet
- Adds Arabic (ar) and French (fr) validation translations
- Works with both resource-based (Laravel 9 and below) and root-based (Laravel 10+) language directories
- Includes translations for auth, validation, pagination, and passwords files
- Simple installation with zero configuration required

## Requirements

- PHP 8.0 or higher
- Laravel 10.0 or higher

## Installation

You can install the package via composer:

```bash
composer require bousbaadev/lang-publisher
```

The package will automatically detect your Laravel version and publish the language files to the appropriate directory.

## Usage

### Automatic Publishing

Language files are automatically published when the package is installed. No additional configuration is required.

### Manual Publishing

If you need to manually publish or update the language files, you can use the following Artisan command:

```bash
php artisan lang:publish
```

To force overwrite existing language files:

```bash
php artisan lang:publish --force
```

## Supported Languages

Currently, the package supports the following languages:

- English (en)
- Arabic (ar)
- French (fr)

## How It Works

The package detects your Laravel version and publishes language files to the appropriate directory:

- For Laravel 10+: `lang/` directory at the root level
- For Laravel 9 and below: `resources/lang/` directory

It provides translations for the following files:

- validation.php
- auth.php
- pagination.php
- passwords.php

## Contributing

### Adding Support for Other Languages

We welcome contributions to add support for additional languages. Here's how you can contribute:

1. **Fork the Repository**
   - Visit the [GitHub repository](https://github.com/zakigit1/LaravelValidation-package)
   - Click the "Fork" button in the top-right corner

2. **Clone Your Fork**
   ```bash
   git clone https://github.com/YOUR_USERNAME/lang-publisher.git
   cd lang-publisher
   ```

3. **Add a New Language**
   - Create a new directory in the `lang` folder with the ISO language code (e.g., `lang/de/` for German)
   - Copy the structure from an existing language folder
   - Translate all files (validation.php, auth.php, pagination.php, passwords.php)
   - Ensure you maintain the same array keys as the English version

4. **Update the Service Provider**
   - Add your new language code to the `ensureLocaleExists` method calls in `LangPublisherServiceProvider.php`

5. **Test Your Changes**
   - Install the package in a Laravel project
   - Verify that your language files are correctly published

6. **Submit a Pull Request**
   - Push your changes to your fork
   - Submit a pull request to the main repository
   - Provide a clear description of your changes

### Translation Guidelines

- Maintain the same array structure and keys as the English version
- Ensure translations are grammatically correct and culturally appropriate
- Use proper character encoding for special characters
- Follow Laravel's translation conventions

## Security

If you discover any security-related issues, please email mohammedilyeszakaria.bousbaa@gmail.com instead of using the issue tracker.

## Credits

- [Mohammed Ilyes Zakaria Bousbaa](https://github.com/bousbaadev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
