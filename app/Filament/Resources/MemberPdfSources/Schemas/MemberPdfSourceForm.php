<?php

namespace App\Filament\Resources\MemberPdfSources\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberPdfSourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('community_member_id')
                    ->label('Linked Community Member')
                    ->relationship('communityMember', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('document_title')
                    ->label('Document / Source Title')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('pdf_path')
                    ->label('Uploaded Private PDF File')
                    ->directory('member_sources')
                    ->disk('local') // Stored in private storage/app/private for strict access security
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240), // 10MB limit
                TextInput::make('source_page_number')
                    ->label('Source Page Number')
                    ->numeric(),
                TextInput::make('reference_info')
                    ->label('Reference / Record Info')
                    ->maxLength(255),
                Textarea::make('extracted_text')
                    ->label('Extracted OCR / Raw Text')
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }
}
