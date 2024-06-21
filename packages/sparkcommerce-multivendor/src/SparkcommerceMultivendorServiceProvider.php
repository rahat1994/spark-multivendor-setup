<?php

namespace Rahat1994\SparkcommerceMultivendor;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Rahat1994\SparkCommerce\Models\SCCategory;
use Rahat1994\SparkCommerce\Models\SCProduct;
use Rahat1994\SparkCommerce\Models\SCReview;
use Rahat1994\SparkCommerce\Models\SCTag;
use Rahat1994\SparkcommerceMultivendor\Commands\SCMVMakeAdminUserCommand;
use Rahat1994\SparkcommerceMultivendor\Commands\SCMVMakeVendorOwnerUserCommand;
use Rahat1994\SparkcommerceMultivendor\Commands\SCMVPublishRolesCommand;
use Rahat1994\SparkcommerceMultivendor\Commands\SparkcommerceMultivendorPublishMigrationsCommand;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;
use Rahat1994\SparkcommerceMultivendor\Testing\TestsSparkcommerceMultivendor;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SparkcommerceMultivendorServiceProvider extends PackageServiceProvider
{
    public static string $name = 'sparkcommerce-multivendor';

    public static string $viewNamespace = 'sparkcommerce-multivendor';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('rahat1994/sparkcommerce-multivendor');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/sparkcommerce-multivendor/{$file->getFilename()}"),
                ], 'sparkcommerce-multivendor-stubs');
            }
        }

        // Add the necessary methods to Sparkcommerce Models to function.
        $this->prepareSparkcommerceModels();
        // Testing
        Testable::mixin(new TestsSparkcommerceMultivendor());
    }

    protected function prepareSparkcommerceModels(): void
    {
        // Add the necessary methods to Sparkcommerce Models to function.
        SCProduct::resolveRelationUsing('sCMVVendor', function ($product) {
            return $product->belongsTo(SCMVVendor::class, 'vendor_id', 'id');
        });

        SCCategory::resolveRelationUsing('sCMVVendor', function ($category) {
            return $category->belongsTo(SCMVVendor::class, 'vendor_id', 'id');
        });

        SCTag::resolveRelationUsing('sCMVVendor', function ($tag) {
            return $tag->belongsTo(SCMVVendor::class, 'vendor_id', 'id');
        });

        SCReview::resolveRelationUsing('sCMVVendor', function ($review) {
            return $review->belongsTo(SCMVVendor::class, 'vendor_id', 'id');
        });
    }

    protected function getAssetPackageName(): ?string
    {
        return 'rahat1994/sparkcommerce-multivendor';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('sparkcommerce-multivendor', __DIR__ . '/../resources/dist/components/sparkcommerce-multivendor.js'),
            Css::make('sparkcommerce-multivendor-styles', __DIR__ . '/../resources/dist/sparkcommerce-multivendor.css'),
            Js::make('sparkcommerce-multivendor-scripts', __DIR__ . '/../resources/dist/sparkcommerce-multivendor.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            SparkcommerceMultivendorPublishMigrationsCommand::class,
            SCMVMakeAdminUserCommand::class,
            SCMVPublishRolesCommand::class,
            SCMVMakeVendorOwnerUserCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'add_vendor_id_to_tags_table',
            'add_vendor_id_to_reviews_table',
            'add_vendor_id_to_products_table',
            'add_vendor_id_to_categories_table',
            'create_sc_mv_vendors_table',
            'create_sc_mv_vendor_requests_table',
            'create_sc_mv_vendor_users_table',
            'create_sc_mv_support_tickets_table',
            'create_sc_mv_payout_requests_table',
            'create_sc_mv_shop_categories_table',
        ];
    }
}
