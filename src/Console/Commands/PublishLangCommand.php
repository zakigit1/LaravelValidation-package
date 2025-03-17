<?php

namespace Bousbaadev\LangPublisher\Console\Commands;

use Bousbaadev\LangPublisher\LangPublisherServiceProvider;
use Illuminate\Console\Command;

class PublishLangCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:publish {--force : Force overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish language files including Arabic and French validation translations';

    /**
     * Execute the console command.
     */
    // public function handle(): int
    // {
    //     $this->info('Publishing language files...');

    //     $force = $this->option('force');

    //     // Tag for lang files
    //     $tag = 'lang';

    //     // Build parameters for the vendor:publish command
    //     $params = ['--tag' => $tag];

    //     if ($force) {
    //         $params['--force'] = true;
    //     }

    //     // Run the vendor:publish command
    //     $this->call('vendor:publish', $params);

    //     $this->info('Language files published successfully!');

    //     return Command::SUCCESS;
    // }


    //! V1
    // public function handle(): int
    // {
    //     $this->info('Publishing language files...');

    //     $force = $this->option('force');

    //     // Build parameters for the vendor:publish command
    //     $params = [
    //         '--tag' => 'lang',
    //         '--force' => $force
    //     ];

    //     // Run the vendor:publish command once
    //     $this->call('vendor:publish', $params);

    //     $this->info('Language files published successfully!');

    //     return Command::SUCCESS;
    // }

    public function handle(): int
    {
        $this->info('Publishing language files...');

        $force = $this->option('force');

        // Build parameters for the vendor:publish command
        $params = [
            '--tag' => 'lang',
            '--force' => $force
        ];

        // Run the vendor:publish command
        $this->call('vendor:publish', $params);

        $langPath = $this->laravel->make('path.lang');
        
        // Ensure all locales exist
        $provider = new LangPublisherServiceProvider($this->laravel);
        $provider->boot();

        $this->info('Language files published successfully!');

        return Command::SUCCESS;
    }
}
