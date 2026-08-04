<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class VastipatrakPdfUploadPage extends Page
{
    protected static ?string $navigationLabel = 'PDF AI Extraction';

    protected static ?string $title = 'PDF AI Data Extraction (વસ્તીપત્રક PDF ઇમ્પોર્ટ)';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedDocumentArrowUp;

    protected static UnitEnum|string|null $navigationGroup = 'Vastipatrak Directory';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.vastipatrak-pdf-upload-page';
}
