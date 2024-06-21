<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\ShopCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\ShopCategoryResource;

class ListShopCategories extends ListRecords
{
    protected static string $resource = ShopCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
