<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PopupBannerResource\Pages;
use App\Models\PopupBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PopupBannerResource extends Resource
{
    protected static ?string $model = PopupBanner::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Promo';
    protected static ?string $navigationLabel = 'Pop-up Promo';
    protected static ?string $pluralModelLabel = 'Pop-up Promo';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Promo')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Nama Promo (Internal)')
                    ->required()
                    ->placeholder('Contoh: Diskon Kemerdekaan'),
                
                Forms\Components\Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(false)
                    ->helperText('Sakelar utama untuk mematikan/menyalakan pop-up secara paksa.'),
            ])->columns(1),

            Forms\Components\Section::make('Penjadwalan & Gambar')->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai Tayang (Opsional)')
                    ->helperText('Jika kosong, langsung tayang hari ini.'),
                
                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Berakhir (Opsional)')
                    ->helperText('Jika kosong, tayang terus sampai dimatikan.'),

                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('popup_image')
                    ->label('Gambar Promo')
                    ->required()
                    ->image()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')->collection('popup_image')->label('Gambar'),
            Tables\Columns\TextColumn::make('title')->label('Nama Promo')->searchable(),
            Tables\Columns\TextColumn::make('start_date')->label('Mulai Tayang')->date('d M Y')->sortable(),
            Tables\Columns\TextColumn::make('end_date')->label('Selesai Tayang')->date('d M Y')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPopupBanners::route('/'),
            'create' => Pages\CreatePopupBanner::route('/create'),
            'edit' => Pages\EditPopupBanner::route('/{record}/edit'),
        ];
    }
}