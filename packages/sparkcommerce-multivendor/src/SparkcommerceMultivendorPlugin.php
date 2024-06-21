<?php

namespace Rahat1994\SparkcommerceMultivendor;

use Filament\Contracts\Plugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Panel;
use Rahat1994\SparkcommerceMultivendor\Enums\PanelType;
use Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy\RegisterVendor;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\ShopCategoryResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;
use Rahat1994\SparkcommerceMultivendor\Http\Middleware\AuthMiddleware;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class SparkcommerceMultivendorPlugin implements Plugin
{
    protected PanelType $panelType = PanelType::Admin;

    final public function __construct(PanelType $panelType)
    {
        $this->panelType($panelType);
    }

    public function getId(): string
    {
        return 'sparkcommerce-multivendor';
    }

    public function getPanelType(): PanelType
    {
        return $this->panelType;
    }

    public function panelType(PanelType $panelType): static
    {
        $this->panelType = $panelType;

        return $this;
    }

    public function register(Panel $panel): void
    {
        $this->getUserSpecificPanel($panel)
            ->authMiddleware([
                Authenticate::class,
                AuthMiddleware::class,
            ]);
    }

    public function getUserSpecificPanel(Panel $panel): Panel
    {
        if ($this->panelType === PanelType::Admin) {
            return $panel->resources(
                $this->getResources()
            );
        } else {
            return $panel->resources(
                $this->getResources()
            )
                ->tenant(SCMVVendor::class, slugAttribute: 'slug')
                ->tenantRegistration(RegisterVendor::class);
        }
    }

    protected function getResources(): array
    {

        if ($this->getPanelType() == PanelType::Admin) {
            return [
                VendorResource::class,
                VendorRequestResource::class,
                PayoutRequestResource::class,
                SupportTicketResource::class,
                ShopCategoryResource::class,
            ];
        }

        return [];
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(PanelType $panelType = PanelType::Admin): static
    {
        $static = app(static::class, ['panelType' => $panelType]);

        return $static;
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
