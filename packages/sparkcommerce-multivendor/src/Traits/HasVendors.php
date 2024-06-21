<?php

namespace Rahat1994\SparkcommerceMultivendor\Traits;

use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

trait HasVendors
{
    public function vendors(): BelongsToMany
    {
        return $this->BelongsToMany(SCMVVendor::class, strval(config('sparkcommerce-multivendor.table_prefix')) . 'user_vendor', 'user_id', 'vendor_id');
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->vendors;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->vendors()->whereKey($tenant)->exists();
    }
}
