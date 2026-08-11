<?php

namespace App\Filament\Resources\Baithaks\Pages;

use App\Filament\Resources\Baithaks\BaithakResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBaithaks extends ListRecords
{
    protected static string $resource = BaithakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
