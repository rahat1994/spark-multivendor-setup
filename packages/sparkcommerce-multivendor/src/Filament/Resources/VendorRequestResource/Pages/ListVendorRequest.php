<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;

class ListVendorRequest extends ListRecords
{
    protected static string $resource = VendorRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
