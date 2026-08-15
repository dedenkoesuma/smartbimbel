<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Halaman Beranda';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Statistik';
    protected static ?string $pluralModelLabel = 'Data Statistik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Statistik')
                    ->description('Masukkan angka dan label yang akan tampil di bawah Hero Banner.')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Angka / Nilai')
                            ->placeholder('Contoh: 15+')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('label')
                            ->label('Teks Label')
                            ->placeholder('Contoh: Tahun Pengalaman')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->searchable()
                    ->weight('bold')
                    ->size('lg'),
                    
                Tables\Columns\TextColumn::make('label')
                    ->label('Label')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit' => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}