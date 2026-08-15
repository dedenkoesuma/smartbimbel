<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LayananBannerResource\Pages;
use App\Models\LayananBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class LayananBannerResource extends Resource
{
    protected static ?string $model = LayananBanner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Halaman Layanan';
    protected static ?string $navigationLabel = 'Banner Layanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Teks Banner')->schema([
                Forms\Components\TextInput::make('eyebrow')
                    ->label('Eyebrow (Teks Kecil Atas)')
                    ->placeholder('Contoh: LAYANAN KAMI'),
                Forms\Components\TextInput::make('title')
                    ->label('Judul Utama')
                    ->required()
                    ->placeholder('Contoh: Program Belajar untuk Setiap Jenjang Pendidikan'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->placeholder('Contoh: Dari SD hingga persiapan UTBK...')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Badge & Visual')->schema([
                Forms\Components\TextInput::make('badge_1_text')
                    ->label('Teks Badge Kiri')
                    ->placeholder('Contoh: Tutor Tersertifikasi'),
                Forms\Components\TextInput::make('badge_2_number')
                    ->label('Angka Badge Kanan')
                    ->placeholder('Contoh: 3'),
                Forms\Components\TextInput::make('badge_2_text')
                    ->label('Teks Badge Kanan')
                    ->placeholder('Contoh: Jenjang Program'),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('layanan_banner')
                    ->label('Foto Banner')
                    ->columnSpanFull(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')->collection('layanan_banner')->label('Foto'),
            Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->limit(30),
            Tables\Columns\TextColumn::make('eyebrow')->label('Eyebrow'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayananBanners::route('/'),
            'create' => Pages\CreateLayananBanner::route('/create'),
            'edit' => Pages\EditLayananBanner::route('/{record}/edit'),
        ];
    }
}