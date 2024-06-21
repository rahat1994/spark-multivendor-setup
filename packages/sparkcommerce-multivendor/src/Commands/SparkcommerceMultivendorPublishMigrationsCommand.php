<?php

namespace Rahat1994\SparkcommerceMultivendor\Commands;

use Illuminate\Console\Command;
use Rahat1994\SparkcommerceMultivendor\SparkcommerceMultivendorServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

class SparkcommerceMultivendorPublishMigrationsCommand extends Command
{
    public $signature = 'scmv:publish-migrations';

    public $description = 'publish all the migrations for sparkcommerce-multivendor package';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--provider' => SparkcommerceMultivendorServiceProvider::class,
            '--tag' => 'sparkcommerce-multivendor-migrations',
        ]);

        $this->call('vendor:publish', [
            '--provider' => PermissionServiceProvider::class,
        ]);

        $this->info('All migrations have been published successfully.');

        return self::SUCCESS;
    }
}
