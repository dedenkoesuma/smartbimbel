<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AboutValueResource\Pages;
use App\Models\AboutValue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutValueResource extends Resource
{
    protected static ?string $model = AboutValue::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Halaman Tentang Kami';
    protected static ?string $navigationLabel = 'Nilai-Nilai';
    protected static ?string $pluralModelLabel = 'Nilai-Nilai';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Nilai')
                ->schema([
                    Forms\Components\TextInput::make('title')->label('Judul Nilai')->required(),
                    Forms\Components\Textarea::make('description')->label('Deskripsi')->required()->rows(3)->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('description')->label('Deskripsi')->limit(50),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
        ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListAboutValues::route('/'),
            'create' => Pages\CreateAboutValue::route('/create'),
            'edit' => Pages\EditAboutValue::route('/{record}/edit'),
        ];
    }
}