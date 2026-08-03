<?php

namespace App\Filament\Resources\MemberPdfSources\Pages;

use App\Filament\Resources\MemberPdfSources\MemberPdfSourceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberPdfSources extends ListRecords
{
    protected static string $resource = MemberPdfSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
