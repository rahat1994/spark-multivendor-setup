<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource;

class EditSupportTicket extends EditRecord
{
    protected static string $resource = SupportTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
