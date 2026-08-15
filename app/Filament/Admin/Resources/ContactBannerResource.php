<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactBannerResource\Pages;
use App\Models\ContactBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ContactBannerResource extends Resource
{
    protected static ?string $model = ContactBanner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Halaman Kontak';
    protected static ?string $navigationLabel = 'Banner Kontak';
    protected static ?string $pluralModelLabel = 'Banner Kontak';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Teks Utama')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Utama')
                    ->required()
                    ->placeholder('Contoh: Ada Pertanyaan? Yuk, Ngobrol Dulu.'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->placeholder('Contoh: Tim Bimbel Smart siap bantu...')
                    ->columnSpanFull(),
            ])->columns(1),

            Forms\Components\Section::make('Kotak Statistik & Foto')->schema([
                Forms\Components\TextInput::make('stat_value')
                    ->label('Nilai Statistik')
                    ->placeholder('Contoh: < 1 jam'),
                Forms\Components\TextInput::make('stat_label')
                    ->label('Label Statistik')
                    ->placeholder('Contoh: Rata-rata respons'),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('contact_banner')
                    ->label('Foto Banner')
                    ->image()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')->collection('contact_banner')->label('Foto'),
            Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactBanners::route('/'),
            'create' => Pages\CreateContactBanner::route('/create'),
            'edit' => Pages\EditContactBanner::route('/{record}/edit'),
        ];
    }
}