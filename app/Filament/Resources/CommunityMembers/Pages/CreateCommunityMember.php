<?php

namespace App\Filament\Resources\CommunityMembers\Pages;

use App\Filament\Resources\CommunityMembers\CommunityMemberResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCommunityMember extends CreateRecord
{
    protected static string $resource = CommunityMemberResource::class;
}
