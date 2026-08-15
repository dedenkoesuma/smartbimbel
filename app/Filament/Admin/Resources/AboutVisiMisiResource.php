<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AboutVisiMisiResource\Pages;
use App\Models\AboutVisiMisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutVisiMisiResource extends Resource
{
    protected static ?string $model = AboutVisiMisi::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Halaman Tentang Kami';
    protected static ?string $navigationLabel = 'Visi & Misi';
    protected static ?string $pluralModelLabel = 'Visi & Misi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Visi Kami')->schema([
                Forms\Components\TextInput::make('visi_title')->label('Judul Visi')->required(),
                Forms\Components\Textarea::make('visi_description')->label('Deskripsi Visi')->required(),
            ]),
            Forms\Components\Section::make('Misi Kami')->schema([
                Forms\Components\TextInput::make('misi_title')->label('Judul Misi')->required(),
                Forms\Components\Repeater::make('misi_points')->label('Poin Misi')
                    ->addActionLabel('Tambah Poin Misi')
                    ->schema([
                        Forms\Components\TextInput::make('point')->label('Isi Poin')->required(),
                    ])->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('visi_title')->label('Judul Visi'),
            Tables\Columns\TextColumn::make('misi_title')->label('Judul Misi'),
            Tables\Columns\TextColumn::make('updated_at')->label('Diupdate')->dateTime(),
        ])->actions([ Tables\Actions\EditAction::make(),Tables\Actions\DeleteAction::make(), ]) ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListAboutVisiMisis::route('/'),
            'create' => Pages\CreateAboutVisiMisi::route('/create'),
            'edit' => Pages\EditAboutVisiMisi::route('/{record}/edit'),
        ];
    }
}