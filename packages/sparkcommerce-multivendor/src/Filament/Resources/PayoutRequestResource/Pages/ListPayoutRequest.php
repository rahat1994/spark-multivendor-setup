<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource;

class ListPayoutRequest extends ListRecords
{
    protected static string $resource = PayoutRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
