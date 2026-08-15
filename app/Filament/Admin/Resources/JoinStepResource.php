<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JoinStepResource\Pages;
use App\Models\JoinStep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JoinStepResource extends Resource
{
    protected static ?string $model = JoinStep::class;
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationGroup = 'Halaman Layanan';
    protected static ?string $navigationLabel = 'Langkah Bergabung';
    protected static ?string $pluralModelLabel = 'Langkah Bergabung';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Langkah')->schema([
                Forms\Components\TextInput::make('step_number')
                    ->label('Nomor Urut Langkah')
                    ->numeric()
                    ->required()
                    ->placeholder('Contoh: 1'),
                Forms\Components\TextInput::make('title')
                    ->label('Judul Langkah')
                    ->required()
                    ->placeholder('Contoh: Konsultasi Gratis'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->placeholder('Contoh: Ceritakan kebutuhan belajar anak Anda...')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('step_number')
                ->label('Langkah Ke-')
                ->sortable()
                ->badge(),
            Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('description')->label('Deskripsi')->limit(50),
        ])
        ->defaultSort('step_number', 'asc')
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
            'index' => Pages\ListJoinSteps::route('/'),
            'create' => Pages\CreateJoinStep::route('/create'),
            'edit' => Pages\EditJoinStep::route('/{record}/edit'),
        ];
    }
}