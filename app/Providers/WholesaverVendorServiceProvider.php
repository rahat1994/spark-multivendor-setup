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
use Illuminate\Database\Eloquent\Model;

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
        $serviceProvider = $this;
        // register a vendor form configuration
        RegisterVendor::macro('configureVendorRegistrationForm', function (Form $form) use ($serviceProvider) {

            return $form
                ->schema($serviceProvider->getVendorInformationFields());
        });

        RegisterVendor::macro('saveRegistrationData', function (array $data) {

            // dd($data);
            $meta = [
                'delivery_days' => $data['delivery_days'],
                'postcodes' => $data['postcodes'],
                'vendor_currency' => $data['vendor_currency'],
            ];
            unset($data['delivery_days']);
            unset($data['postcodes']);
            unset($data['vendor_currency']);

            $data['meta'] = $meta;
            $vendor = SCMVVendor::create($data);
            $vendor->members()->attach(auth()->user());
            return $vendor;
        });

        // register a vendor edit form configuration
        EditVendorProfile::macro('configureVendorProfileEditForm', function (Form $form) use($serviceProvider) {
            // dd($this->tenant);
            return $form
                ->schema($serviceProvider->getVendorInformationFields());
        });

        EditVendorProfile::macro('saveProfileUpdatedData', function (Model $record, array $data) {
            $meta = [
                'delivery_days' => $data['delivery_days'],
                'postcodes' => $data['postcodes'],
                'vendor_currency' => $data['vendor_currency'],
            ];
            unset($data['delivery_days']);
            unset($data['postcodes']);
            unset($data['vendor_currency']);

            $data['meta'] = $meta;
            $this->tenant->update($data);
            return $this->tenant;
        });

        EditVendorProfile::macro('mutateVendorProfileDataBeforeEditFormFieldFill', function (array $data) {
            $data['delivery_days'] = $data['meta']['delivery_days'] ?? [];
            $data['postcodes'] = $data['meta']['postcodes'] ?? [];
            return $data;
        });
    }

    public function getVendorInformationFields(): array
    {
        return [
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
            Select::make('vendor_currency')
                ->label('Vendor Currency')
                ->options([
                    'GBP' => 'Great Britain Pound',
                    'USD' => 'United States Dollar',
                    'EUR' => 'Euro',
                    'AED' => 'United Arab Emirates Dirham',
                    'AUD' => 'Australian Dollar',
                    'BDT' => 'Bangladeshi Taka',
                ]),
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
        ];
    }
}
