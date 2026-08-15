<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Halaman Tentang Kami';
    protected static ?string $navigationLabel = 'Testimoni';
    protected static ?string $pluralModelLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Testimoni')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                Forms\Components\TextInput::make('role')
                    ->label('Peran / Status (Contoh: Siswa SMA)')
                    ->required(),
                Forms\Components\Textarea::make('message')
                    ->label('Isi Pesan Testimoni')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->collection('testi_avatars')
                    ->label('Foto Profil (Opsional)')
                    ->image()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                ->collection('testi_avatars')
                ->label('Foto')
                ->circular()
                ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&background=2C3E9E&color=fff&bold=true'),
            Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('role')->label('Peran')->searchable(),
            Tables\Columns\TextColumn::make('message')->label('Pesan')->limit(40),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]) ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}