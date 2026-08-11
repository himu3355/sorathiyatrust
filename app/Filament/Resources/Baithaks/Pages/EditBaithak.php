<?php

namespace App\Filament\Resources\Baithaks\Pages;

use App\Filament\Resources\Baithaks\BaithakResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBaithak extends EditRecord
{
    protected static string $resource = BaithakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
