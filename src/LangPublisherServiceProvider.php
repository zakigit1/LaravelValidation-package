<?php

namespace Bousbaadev\LangPublisher;

use Illuminate\Support\ServiceProvider;
use Bousbaadev\LangPublisher\Console\Commands\PublishLangCommand;

class LangPublisherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the command
        $this->commands([
            PublishLangCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Define publishable language files
        $this->publishes([
            __DIR__ . '/../lang' => $this->getLangPath(),
        ], 'lang');

        // Auto-publish when package is installed
        $this->registerPublishingCallbacks();
    }

    /**
     * Get the lang path for the application.
     */
    protected function getLangPath(): string
    {
        // For Laravel 10+ the lang folder is in the base directory
        if (function_exists('lang_path')) {
            return lang_path();
        }

        // For Laravel 9 and below, check if the application has a separate lang directory
        if (is_dir(base_path('lang'))) {
            return base_path('lang');
        }

        // Fall back to the lang directory for older versions
        return resource_path('lang');
    }

    /**
     * Register callbacks for auto-publishing.
     */
    protected function registerPublishingCallbacks(): void
    {
        // Run when package is installed via composer
        $this->callAfterResolving('translator', function () {
            $this->handleAutoPublish();
        });
    }

    /**
     * Handle auto-publishing of language files.
     */
    protected function handleAutoPublish(): void
    {
        $langPath = $this->getLangPath();

        // Check if lang folder exists and has been published
        if (!$this->langFolderPublished($langPath)) {
            $this->publishLangFolder();
        }

        // Ensure ar and fr validation folders exist
        $this->ensureLocaleExists($langPath, 'ar');
        $this->ensureLocaleExists($langPath, 'fr');
    }

    /**
     * Check if lang folder has been published.
     */
    protected function langFolderPublished(string $path): bool
    {
        // If lang path doesn't exist at all
        if (!file_exists($path)) {
            return false;
        }

        // Check if English validation file exists (a common core translation)
        // For Laravel 10+, it's directly in the lang/en directory
        if (file_exists($path . '/en/validation.php')) {
            return true;
        }

        // For older Laravel versions, check the old location
        if (file_exists($path . '/validation.php')) {
            return true;
        }

        return false;
    }

    /**
     * Publish language folder.
     */
    protected function publishLangFolder(): void
    {
        $this->callArtisanPublish();
    }

    /**
     * Call artisan publish command.
     */
    protected function callArtisanPublish(): void
    {
        $this->app->make('files')->ensureDirectoryExists($this->getLangPath());

        // Publish language files
        $this->publishes([
            __DIR__ . '/../lang' => $this->getLangPath(),
        ], 'lang');

        $this->app->make('command.vendor.publish')->handle([
            '--tag' => 'lang',
            '--force' => true,
        ]);
    }

    /**
     * Ensure locale exists and has validation translations.
     */
    protected function ensureLocaleExists(string $basePath, string $locale): void
    {
        $localePath = $basePath . '/' . $locale;

        // Create locale directory if it doesn't exist
        if (!file_exists($localePath)) {
            mkdir($localePath, 0755, true);
        }

        // Check if validation.php exists in locale folder
        $validationFile = $localePath . '/validation.php';
        if (!file_exists($validationFile)) {
            // Copy our package validation file
            copy(
                __DIR__ . '/../lang/' . $locale . '/validation.php',
                $validationFile
            );
        }
    }
}
