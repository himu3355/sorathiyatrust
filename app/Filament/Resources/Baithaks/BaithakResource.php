<?php

namespace App\Filament\Resources\Baithaks;

use App\Filament\Resources\Baithaks\Pages\CreateBaithak;
use App\Filament\Resources\Baithaks\Pages\EditBaithak;
use App\Filament\Resources\Baithaks\Pages\ListBaithaks;
use App\Filament\Resources\Baithaks\Schemas\BaithakForm;
use App\Filament\Resources\Baithaks\Tables\BaithaksTable;
use App\Models\Baithak;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BaithakResource extends Resource
{
    protected static ?string $model = Baithak::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static UnitEnum|string|null $navigationGroup = 'Directory & Trust';

    protected static ?string $modelLabel = 'બેઠકજી';

    protected static ?string $pluralModelLabel = '૮૪ બેઠકજી વિગતો';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'city_village_guj';

    public static function form(Schema $schema): Schema
    {
        return BaithakForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BaithaksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBaithaks::route('/'),
            'create' => CreateBaithak::route('/create'),
            'edit' => EditBaithak::route('/{record}/edit'),
        ];
    }
}
