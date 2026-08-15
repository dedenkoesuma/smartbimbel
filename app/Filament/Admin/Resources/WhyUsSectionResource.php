<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WhyUsSectionResource\Pages;
use App\Models\WhyUsSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class WhyUsSectionResource extends Resource
{
    protected static ?string $model = WhyUsSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Halaman Beranda';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Kenapa Pilih Kami';
    protected static ?string $pluralModelLabel = 'Kenapa Pilih Kami';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Teks Utama')
                    ->schema([
                        Forms\Components\TextInput::make('eyebrow')
                            ->label('Teks Kecil (Eyebrow)')
                            ->placeholder('Contoh: KENAPA BIMBEL SMART')
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Utama')
                            ->placeholder('Contoh: Kenapa Pilih Bimbel Smart?')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Gambar Visual')
                    ->description('Masukkan dua gambar untuk melengkapi bagian ini.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image_primary')
                            ->collection('why_us_primary')
                            ->label('Gambar Besar (Utama)')
                            ->required(),
                            
                        SpatieMediaLibraryFileUpload::make('image_secondary')
                            ->collection('why_us_secondary')
                            ->label('Gambar Kecil (Overlay)')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Keunggulan / Poin-Poin')
                    ->schema([
                        Forms\Components\Repeater::make('points')
                            ->label('Daftar Keunggulan')
                            ->addActionLabel('Tambah Poin Baru')
                            ->schema([
                                Forms\Components\TextInput::make('point_text')
                                    ->label('Teks Keunggulan')
                                    ->placeholder('Contoh: Kurikulum terupdate & relevan')
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->columnSpanFull()
                            ->reorderable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image_primary')
                    ->collection('why_us_primary')
                    ->label('Gambar Utama')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(40)
                    ->searchable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhyUsSections::route('/'),
            'create' => Pages\CreateWhyUsSection::route('/create'),
            'edit' => Pages\EditWhyUsSection::route('/{record}/edit'),
        ];
    }
}