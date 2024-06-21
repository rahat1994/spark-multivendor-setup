<?php

namespace Rahat1994\SparkcommerceMultivendor\Commands;

use Filament\Facades\Filament;
use Illuminate\Auth\EloquentUserProvider;
// use Illuminate\Auth\Authenticatable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:scmv-admin-user')]
class SCMVMakeAdminUserCommand extends Command
{
    public $signature = 'make:scmv-admin-user
                            {--name= : The name of the admin user}
                            {--email= : The email of the admin user}
                            {--password= : The password of the admin user (min. 8 characters)}';

    public $description = 'Create a new SCMV admin user';

    protected array $options;

    protected function getUserData(): array
    {
        return [
            'name' => $this->option('name') ?? $this->ask('Enter the name of the admin user'),
            'email' => $this->option('email') ?? text(
                label: 'Email address',
                required: true,
                validate: fn (string $email): ?string => match (true) {
                    ! filter_var($email, FILTER_VALIDATE_EMAIL) => 'The email address must be valid.',
                    static::getUserModel()::where('email', $email)->exists() => 'A user with this email address already exists',
                    default => null,
                },
            ),
            'password' => Hash::make($this->options['password'] ?? password(
                label: 'Password (min 8 characters)',
                required: true,
                validate: fn (string $password): ?string => strlen($password) < 8 ? 'The password must be at least 8 characters long.' : null,
            )),
        ];
    }

    protected function createUser(): Authenticatable
    {
        return static::getUserModel()::create($this->getUserData());
    }

    protected function sendSuccessMessage(Authenticatable $user): void
    {
        $this->components->info('Success! ' . ($user->getAttribute('email') ?? $user->getAttribute('username') ?? 'You') . ' may now log in.');
    }

    protected function getAuthGuard(): Guard
    {
        return Filament::auth();
    }

    protected function getUserProvider(): UserProvider
    {
        return $this->getAuthGuard()->getProvider();
    }

    protected function getUserModel(): string
    {
        /** @var EloquentUserProvider $provider */
        $provider = $this->getUserProvider();

        return $provider->getModel();
    }

    public function handle(): int
    {

        if (! Filament::getCurrentPanel()) {
            $this->error('Filament has not been installed yet: php artisan filament:install');

            return static::INVALID;
        }

        $adminRoleLabel = config('sparkcommerce-multivendor.admin_role');

        // TODO: Check if roles have been published
        // TODO: [Documentation] Add a note about publishing roles.

        if (Role::where('name', $adminRoleLabel)->first() === null) {
            $this->error('Roles have not been published yet: php artisan scmv:publish-roles');

            return static::INVALID;
        }

        $this->options = $this->options();
        $user = $this->createUser();

        $user->assignRole($adminRoleLabel);
        $this->sendSuccessMessage($user);

        return static::SUCCESS;
    }
}
