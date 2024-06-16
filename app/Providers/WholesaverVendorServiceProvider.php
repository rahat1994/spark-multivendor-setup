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


        VendorResource::macro('tableActions', function () {
            $topVendor = Action::make('make_top_vendor')
                ->label('Make Top Vendor')
                // ->requiresConfirmation()
                ->visible(function (SCMVVendor $record) {
                    return ($record->meta == null || $record->meta['is_top_vendor'] != 1);
                })
                ->action(function (SCMVVendor $record) {
                    // dd($record->meta);

                    if ($record->meta == null) {

                        $record->meta = [
                            'is_top_vendor' => 1
                        ];

                        $record->save();
                    }
                });

            $demoteVendor = Action::make('demote_vendor')
                ->label('Demote Vendor')
                // ->requiresConfirmation()
                ->visible(function (SCMVVendor $record) {
                    return ($record->meta != null && $record->meta['is_top_vendor'] == 1);
                })
                ->action(function (SCMVVendor $record) {
                    // dd($record->meta);

                    if ($record->meta == null) {
                        $record->meta = [
                            'is_top_vendor' => 0
                        ];
                        $record->save();
                    }
                });

            return [
                ActionsEditAction::make(),
                $topVendor,
                $demoteVendor
            ];
        });
    }
}
