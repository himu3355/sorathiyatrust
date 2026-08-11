<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSiteSettingsPage extends Page
{
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static UnitEnum|string|null $navigationGroup = 'Vastipatrak Directory';

    protected static ?string $title = 'Site Settings (સાઈટ સેટિંગ્સ)';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.manage-site-settings-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'whatsapp_number' => SiteSetting::get('whatsapp_number', '919876543210'),
            'facebook_url' => SiteSetting::get('facebook_url', 'https://facebook.com/'),
            'youtube_url' => SiteSetting::get('youtube_url', 'https://youtube.com/'),
            'instagram_url' => SiteSetting::get('instagram_url', 'https://instagram.com/'),
            'twitter_url' => SiteSetting::get('twitter_url', 'https://x.com/'),
            'phone_number' => SiteSetting::get('phone_number', '+91 98765 43210'),
            'contact_email' => SiteSetting::get('contact_email', 'info@trustwebsite.org'),
            'office_address' => SiteSetting::get('office_address', 'મહાજન વાડી, રાજકોટ, ગુજરાત.'),
            'stat_members_label' => SiteSetting::get('stat_members_label', '૧૫૦૦+'),
            'stat_years_label' => SiteSetting::get('stat_years_label', '૫૦+'),
            'stat_events_label' => SiteSetting::get('stat_events_label', '૨૫+'),
            'stat_commitment_label' => SiteSetting::get('stat_commitment_label', '૧૦૦%'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('📱 Social Links & Contact Details (સોશિયલ લિંક્સ અને સંપર્ક)')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp Number (with country code, e.g. 919876543210)'),
                        TextInput::make('phone_number')
                            ->label('Public Phone Number (e.g. +91 98765 43210)'),
                        TextInput::make('contact_email')
                            ->label('Public Email Address'),
                        TextInput::make('office_address')
                            ->label('Office Address (કાર્યાલય સરનામું)'),
                        TextInput::make('facebook_url')
                            ->label('Facebook Page URL'),
                        TextInput::make('youtube_url')
                            ->label('YouTube Channel URL'),
                        TextInput::make('instagram_url')
                            ->label('Instagram Profile URL'),
                        TextInput::make('twitter_url')
                            ->label('Twitter / X URL'),
                    ])->columns(2),

                Section::make('📊 Community Impact & Statistics (આંકડાકીય વિગત)')
                    ->schema([
                        TextInput::make('stat_members_label')
                            ->label('Total Members Stat Label (e.g. ૧૫૦૦+)'),
                        TextInput::make('stat_years_label')
                            ->label('Years of Service Stat Label (e.g. ૫૦+)'),
                        TextInput::make('stat_events_label')
                            ->label('Annual Events Stat Label (e.g. ૨૫+)'),
                        TextInput::make('stat_commitment_label')
                            ->label('Commitment Stat Label (e.g. ૧૦૦%)'),
                    ])->columns(2),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $val) {
            SiteSetting::set($key, $val);
        }

        Notification::make()
            ->title('Site Settings saved successfully!')
            ->success()
            ->send();
    }
}
