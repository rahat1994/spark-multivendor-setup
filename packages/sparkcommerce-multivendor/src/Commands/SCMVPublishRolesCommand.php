<?php

namespace Rahat1994\SparkcommerceMultivendor\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'scmv:publish-roles')]
class SCMVPublishRolesCommand extends Command
{
    public $signature = 'scmv:publish-roles';

    public $description = 'Publish roles for Sparkcommerce Multivendor';

    public function handle()
    {
        $adminRole = config('sparkcommerce-multivendor.admin_role');
        $vendorOwnerRole = config('sparkcommerce-multivendor.vendor_owner_role');
        $vendorManagerRole = config('sparkcommerce-multivendor.vendor_manager_role');
        $customerRole = config('sparkcommerce-multivendor.customer_role');

        $this->publishAdminPermissionsAndRole();
        $this->publishVendorOwnerPermissionsAndRole();
    }

    protected function publishVendorOwnerPermissionsAndRole()
    {
        $vendorOwnerRole = config('sparkcommerce-multivendor.vendor_owner_role');
        $vendorOwnerPermissions = config('sparkcommerce-multivendor.vendor_owner_permissions');

        collect($vendorOwnerPermissions)->each(function ($permissionName, $permissionLabel) {
            Permission::firstOrCreate(['name' => $permissionLabel]);
        });

        $role = Role::firstOrCreate(['name' => $vendorOwnerRole]);
        $role->syncPermissions(array_keys($vendorOwnerPermissions));
    }

    protected function publishAdminPermissionsAndRole()
    {
        $adminRole = config('sparkcommerce-multivendor.admin_role');
        $adminPermissions = config('sparkcommerce-multivendor.admin_permissions');

        collect($adminPermissions)->each(function ($permissionName, $permissionLabel) {
            Permission::firstOrCreate(['name' => $permissionLabel]);
        });
        // dd($adminRole);

        $role = Role::firstOrCreate(['name' => $adminRole]);
        $role->syncPermissions(array_keys($adminPermissions));
    }
}
