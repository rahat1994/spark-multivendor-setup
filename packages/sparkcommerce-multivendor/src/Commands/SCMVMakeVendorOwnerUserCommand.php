<?php

namespace Rahat1994\SparkcommerceMultivendor\Commands;

use Filament\Commands\MakeUserCommand;
use Filament\Facades\Filament;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:scmv-vendor-owner-user')]
class SCMVMakeVendorOwnerUserCommand extends MakeUserCommand
{
    protected $description = 'Create a new SCMV vendor owner user';

    protected $signature = 'make:scmv-vendor-owner-user
                            {--name= : The name of the vendor owner user}
                            {--email= : The email of the vendor owner user}
                            {--password= : The password of the vendor owner user (min. 8 characters)}';

    public function handle(): int
    {

        $this->options = $this->options();

        if (! Filament::getCurrentPanel()) {
            $this->error('Filament has not been installed yet: php artisan filament:install --panels');

            return static::INVALID;
        }

        $vendorOwnerRoleLabel = config('sparkcommerce-multivendor.vendor_owner_role');

        // TODO: Check if roles have been published
        // TODO: [Documentation] Add a note about publishing roles.

        if (Role::where('name', $vendorOwnerRoleLabel)->first() === null) {
            $this->error('Roles have not been published yet: php artisan scmv:publish-roles');

            return static::INVALID;
        }

        $user = $this->createUser();

        $user->assignRole($vendorOwnerRoleLabel);
        $this->sendSuccessMessage($user);

        return static::SUCCESS;
    }
}
