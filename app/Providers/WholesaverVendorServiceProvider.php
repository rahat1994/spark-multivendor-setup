<?php

namespace App\Providers;

use Filament\Tables\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\ServiceProvider;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;

use Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy\EditVendorProfile;
use Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy\RegisterVendor;
use Filament\Forms\Form;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Pages\Auth\Register;
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class WholesaverVendorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // register a vendor form configuration
        RegisterVendor::macro('configureVendorRegistrationForm', function (Form $form) {

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
                    TextInput::make('address')
                        ->label('Address')
                        ->required()
                        ->placeholder('Adress of the vendor'),
                    TextInput::make('contact_number')
                        ->label('Contact Number')
                        ->required()
                        ->placeholder('Phone Number'),
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->placeholder('johndoe@example.com'),
                    Select::make('delivery_days')
                        ->label('Delivery Date')
                        ->multiple()
                        ->options([
                            'Saturday',
                            'Sunday',
                            'Monday',
                            'Tuesday',
                            'Wednesday',
                            'Thursday',
                            'Friday',
                        ]),
                    TagsInput::make('postcodes')
                        ->label('Postcodes')
                        ->required()
                        ->placeholder('Postcodes where the vendor delivers'),
                    SpatieMediaLibraryFileUpload::make('logo')
                        ->collection('Logo')
                        ->label('Logo')
                        ->previewable()
                        ->required()
                        ->image()
                        ->placeholder('Upload a logo for the vendor'),
                    SpatieMediaLibraryFileUpload::make('background_image')
                        ->label('Background Image')
                        ->required()
                        ->image()
                        ->placeholder('Upload a background image for the vendor'),
                ]);
        });

        RegisterVendor::macro('saveRegistrationData', function (array $data) {

            // dd($data);
            $meta = [
                'delivery_days' => $data['delivery_days'],
                'postcodes' => $data['postcodes'],
            ];
            unset($data['delivery_days']);
            unset($data['postcodes']);

            $data['meta'] = $meta;
            $vendor = SCMVVendor::create($data);
            $vendor->members()->attach(auth()->user());
            return $vendor;
        });

        // register a vendor edit form configuration
        EditVendorProfile::macro('configureVendorProfileEditForm', function (Form $form) {
            // dd($this->tenant);
            return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Vendor Name')
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
                    TextInput::make('contact_number')
                        ->label('Contact Number')
                        ->required()
                        ->placeholder('Phone Number'),
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->placeholder('johndoe@example.com'),
                    Select::make('delivery_days')
                        ->label('Delivery Days')
                        ->multiple()
                        ->options([
                            'Saturday' => 'Saturday',
                            'Sunday'=>'Sunday',
                            'Monday'=>'Monday',
                            'Tuesday'=>'Tuesday',
                            'Wednesday'=>'Wednesday',
                            'Thursday'=>'Thursday',
                            'Friday'=>'Friday',
                        ])->afterStateHydrated(function (Select $component) {
                            if (isset($this->tenant->meta['delivery_days'])){
                                $component->state($this->tenant->meta['delivery_days']);
                            }
                        }),
                    TagsInput::make('postcodes')
                        ->label('Postcodes')
                        ->required()
                        ->placeholder('Postcodes where the vendor delivers')
                        ->afterStateHydrated(function (TagsInput $component) {
                            //  = $component->state([2, 4]);
                            $this->tenant;
                            if(isset($this->tenant->meta['postcodes'])){
                                $component->state($this->tenant->meta['postcodes']);
                            }                            
                        }),
                    // SpatieMediaLibraryFileUpload::make('product_image')
                    //     ->collection('product_image')
                    //     ->hiddenLabel()
                    //     ->image(),
                    SpatieMediaLibraryFileUpload::make('logo')
                        ->collection('Logo')
                        ->label('Logo')
                        ->previewable()
                        ->required()
                        ->image()
                        ->placeholder('Upload a logo for the vendor'),
                    SpatieMediaLibraryFileUpload::make('background_image')
                        ->label('Background Image')
                        ->required()
                        ->image()
                        ->placeholder('Upload a background image for the vendor'),
                ]);
        });
    }
}
