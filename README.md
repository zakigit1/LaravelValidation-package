# Laravel Lang Publisher

A Laravel package that automatically publishes language folders and adds Arabic (ar) and French (fr) validation translations. Compatible with all Laravel versions including Laravel 10+ where the lang directory is at the root level.

## Features

- Automatically detects and adapts to your Laravel version's language folder structure
- Publishes language files if they haven't been published yet
- Adds Arabic (ar) and French (fr) validation translations
- Works with both resource-based (Laravel 9 and below) and root-based (Laravel 10+) language directories

## Installation

You can install the package via composer:

```bash
composer require bousbaadev/lang-publisher