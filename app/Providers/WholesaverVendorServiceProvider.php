<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;

use Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy\RegisterVendor;
use Filament\Forms\Form;

class WholesaverVendorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RegisterVendor::macro('configureForm', function (Form $form) {
            return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->placeholder('Custom Store Name'),
                    Select::make('category')
                        ->label('Category')
                        ->required()
                        ->options([
                            'Pultry' => 'Poultry',
                            'Drinks' => 'Drinks',
                            'Fish' => 'Fish',
                        ]),
                    TextInput::make('contanct_number')
                        ->label('Contact Number')
                        ->required()
                        ->placeholder('Phone Number'),
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->placeholder('johndoe@example.com'),
                    TagsInput::make('postcodes')
                        ->label('Postcodes')
                        ->required()
                        ->placeholder('Postcodes where the vendor delivers'),
                ]);
        });
    }
}
