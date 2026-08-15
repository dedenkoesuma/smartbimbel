<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AboutStoryResource\Pages;
use App\Models\AboutStory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AboutStoryResource extends Resource
{
    protected static ?string $model = AboutStory::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Halaman Tentang Kami';
    protected static ?string $navigationLabel = 'Cerita Kami';
    protected static ?string $pluralModelLabel = 'Cerita Kami';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Konten Cerita')->schema([
                Forms\Components\TextInput::make('eyebrow')->label('Teks Kecil (Eyebrow)'),
                Forms\Components\TextInput::make('title')->label('Judul Cerita')->required(),
                Forms\Components\RichEditor::make('description')->label('Isi Cerita')->required()->columnSpanFull(),
                Forms\Components\TextInput::make('badge_number')->label('Angka Badge (Contoh: 15+)'),
                Forms\Components\TextInput::make('badge_label')->label('Label Badge (Contoh: Tahun Membimbing)'),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('about_story')
                    ->label('Foto Cerita')
                    ->required()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')->collection('about_story')->label('Foto')->circular(),
            Tables\Columns\TextColumn::make('title')->label('Judul')->limit(40),
            Tables\Columns\TextColumn::make('updated_at')->label('Diupdate')->dateTime(),
        ])->actions([ Tables\Actions\EditAction::make(),Tables\Actions\DeleteAction::make(), ]) ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListAboutStories::route('/'),
            'create' => Pages\CreateAboutStory::route('/create'),
            'edit' => Pages\EditAboutStory::route('/{record}/edit'),
        ];
    }
}