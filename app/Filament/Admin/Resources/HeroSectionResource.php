<?php

namespace App\Filament\Admin\Resources; // Sudah diperbaiki (ditambah \Admin\)

use App\Filament\Admin\Resources\HeroSectionResource\Pages; // Sudah diperbaiki (ditambah \Admin\)
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    // Mengganti icon dan mengatur posisi di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-window';
    protected static ?string $navigationGroup = 'Halaman Beranda'; // Disesuaikan dengan nama page
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Banner Utama';
    protected static ?string $pluralModelLabel = 'Banner Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Teks & Konten')
                    ->description('Atur teks yang muncul di bagian paling atas website dihalaman home.')
                    ->schema([
                        Forms\Components\TextInput::make('eyebrow')
                            ->label('Teks Kecil (Eyebrow)')
                            ->placeholder('Contoh: Bimbel Pilihan No. 1')
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Utama (Title)')
                            ->placeholder('Contoh: Belajar Lebih Seru...')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Visual & Status')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('hero_image')
                            ->collection('hero_images') // Nama collection Spatie
                            ->label('Foto Hero')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif Tayang')
                            ->default(true)
                            ->helperText('Hanya 1 data yang akan ditampilkan di halaman depan.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('hero_image')
                    ->collection('hero_images')
                    ->label('Foto')
                    ->circular(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('eyebrow')
                    ->label('Eyebrow')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

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
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}