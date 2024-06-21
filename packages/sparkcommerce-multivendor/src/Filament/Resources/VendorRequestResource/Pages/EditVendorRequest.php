<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;

class EditVendorRequest extends EditRecord
{
    protected static string $resource = VendorRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
