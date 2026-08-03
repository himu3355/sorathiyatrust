<?php

namespace App\Filament\Resources\CommunityMembers\Pages;

use App\Filament\Resources\CommunityMembers\CommunityMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCommunityMembers extends ListRecords
{
    protected static string $resource = CommunityMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
