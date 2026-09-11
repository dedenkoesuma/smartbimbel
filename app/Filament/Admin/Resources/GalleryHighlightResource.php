<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GalleryHighlightResource\Pages;
use App\Filament\Admin\Resources\GalleryHighlightResource\RelationManagers;
use App\Models\GalleryHighlight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class GalleryHighlightResource extends Resource
{
    protected static ?string $model = GalleryHighlight::class;

    // Sesuaikan posisi di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Halaman Galeri';
    protected static ?string $navigationLabel = 'Highlight Banner';
    protected static ?int $navigationSort = 1; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Gambar Mozaik')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul / Alt Text')
                            ->placeholder('Contoh: Siswa sedang try out')
                            ->maxLength(255),

                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('gallery_highlights') // Nama koleksi di tabel media
                            ->label('Gambar Highlight')
                            ->required()
                            ->columnSpan('full'),

                        Forms\Components\Select::make('position')
                            ->label('Posisi Gambar (1-6)')
                            ->options([
                                1 => 'Posisi 1 (Kiri Atas - Vertikal)',
                                2 => 'Posisi 2 (Tengah Atas - Persegi)',
                                3 => 'Posisi 3 (Kanan Atas - Persegi)',
                                4 => 'Posisi 4 (Tengah Bawah - Persegi)',
                                5 => 'Posisi 5 (Kanan Bawah - Persegi)',
                                6 => 'Posisi 6 (Kiri Bawah - Horizontal)',
                            ])
                            ->required()
                            ->default(1)
                            ->helperText('Pastikan mengisi posisi 1 sampai 6 agar layout mozaik tidak rusak.'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('gallery_highlights') // Harus sama dengan nama koleksi di form
                    ->label('Gambar')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('position')
                    ->label('Posisi')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('position', 'asc')
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
            'index' => Pages\ListGalleryHighlights::route('/'),
            'create' => Pages\CreateGalleryHighlight::route('/create'),
            'edit' => Pages\EditGalleryHighlight::route('/{record}/edit'),
        ];
    }
}