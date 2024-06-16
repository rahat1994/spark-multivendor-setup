<?php

namespace App\Providers;

use Filament\Tables\Actions\Action;
use Filament\Actions\EditAction;
use Illuminate\Support\ServiceProvider;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;

use Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy\RegisterVendor;
use Filament\Forms\Form;
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

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
        // register a vendor form configuration
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

        // vendor resource Top vendor
        // VendorResource::macro('tableActions', function () {
        // //     if (get_class() == VendorResource::class) {


        // //     }
        // // });

        // VendorRequestResource::macro('tableActions', function () {
        //     dd("Hello");
        // });
    }
}
