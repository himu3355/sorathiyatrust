<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SystemToolsPage extends Page
{
    protected static ?string $navigationLabel = 'System Tools';

    protected static ?string $title = 'સિસ્ટમ ટૂલ્સ (Export & Duplicates)';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static UnitEnum|string|null $navigationGroup = 'Vastipatrak Directory';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.system-tools-page';
}
