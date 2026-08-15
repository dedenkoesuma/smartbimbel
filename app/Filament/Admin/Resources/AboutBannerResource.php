<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AboutBannerResource\Pages;
use App\Models\AboutBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AboutBannerResource extends Resource
{
    protected static ?string $model = AboutBanner::class;
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Halaman Tentang Kami';
    protected static ?string $navigationLabel = 'Banner Utama';
    protected static ?string $pluralModelLabel = 'Banner Utama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Konten Banner')
                ->description('Hanya isi 1 data saja untuk bagian ini.')
                ->schema([
                    Forms\Components\TextInput::make('title')->label('Judul Banner')->required(),
                    Forms\Components\Textarea::make('description')->label('Deskripsi')->required()->rows(3),
                    Forms\Components\TextInput::make('stat_number')->label('Angka Statistik (Contoh: 15+)'),
                    Forms\Components\TextInput::make('stat_label')->label('Label Statistik (Contoh: Tahun Pengalaman)'),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection('about_banner')
                        ->label('Foto Banner')
                        ->required()
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')->collection('about_banner')->label('Foto')->circular(),
            Tables\Columns\TextColumn::make('title')->label('Judul')->limit(40),
            Tables\Columns\TextColumn::make('updated_at')->label('Diupdate')->dateTime(),
        ])->actions([ Tables\Actions\EditAction::make(),Tables\Actions\DeleteAction::make() ]) ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListAboutBanners::route('/'),
            'create' => Pages\CreateAboutBanner::route('/create'),
            'edit' => Pages\EditAboutBanner::route('/{record}/edit'),
        ];
    }
}