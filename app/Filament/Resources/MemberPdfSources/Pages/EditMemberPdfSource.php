<?php

namespace App\Filament\Resources\MemberPdfSources\Pages;

use App\Filament\Resources\MemberPdfSources\MemberPdfSourceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberPdfSource extends EditRecord
{
    protected static string $resource = MemberPdfSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
