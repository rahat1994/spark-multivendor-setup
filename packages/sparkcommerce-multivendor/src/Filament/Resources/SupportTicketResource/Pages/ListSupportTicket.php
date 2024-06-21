<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource;

class ListSupportTicket extends ListRecords
{
    protected static string $resource = SupportTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
