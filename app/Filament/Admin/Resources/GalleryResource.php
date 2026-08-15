<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GalleryResource\Pages;
use App\Filament\Admin\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Halaman Galeri';
    protected static ?string $navigationLabel = 'Galeri Foto';
    protected static ?string $pluralModelLabel = 'Galeri Foto';
    protected static ?string $modelLabel = 'Galeri Foto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul / Keterangan Foto')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->label('Kategori')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Kelas Interaktif, Try Out, dll'),

                DatePicker::make('date')
                    ->label('Tanggal Kegiatan')
                    ->required(),
                    
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Foto Galeri')
                    ->collection('gallery_images')
                    ->required()
                    ->columnSpanFull(),
                    
                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
                    
                Toggle::make('is_active')
                    ->label('Tampilkan di Website?')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto')
                    ->collection('gallery_images'),
                    
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                    
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                    
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
