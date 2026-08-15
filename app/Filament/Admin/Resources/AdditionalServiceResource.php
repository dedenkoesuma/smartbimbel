<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AdditionalServiceResource\Pages;
use App\Models\AdditionalService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AdditionalServiceResource extends Resource
{
    protected static ?string $model = AdditionalService::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?string $navigationGroup = 'Halaman Layanan';
    protected static ?string $navigationLabel = 'Layanan Tambahan';
    protected static ?string $pluralModelLabel = 'Layanan Tambahan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Layanan Tambahan')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Nama Layanan (Otomatis Generate Icon)')
                    ->required()
                    ->placeholder('Contoh: Kelas Privat 1-on-1'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->required()
                    ->placeholder('Contoh: Bimbingan personal dengan perhatian penuh...')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Layanan')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('description')->label('Deskripsi')->limit(50),
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
            'index' => Pages\ListAdditionalServices::route('/'),
            'create' => Pages\CreateAdditionalService::route('/create'),
            'edit' => Pages\EditAdditionalService::route('/{record}/edit'),
        ];
    }
}