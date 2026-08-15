<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    // Mengganti icon di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    // Mengelompokkan menu (Bisa kamu sesuaikan misal jadi 'Halaman Beranda' atau 'Data Akademik')
    protected static ?string $navigationGroup = 'Halaman Beranda';
    
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Daftar Program';
    protected static ?string $pluralModelLabel = 'Program Belajar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Program')
                    ->description('Masukkan detail program belajar. Icon akan otomatis menyesuaikan dengan nama program.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Program')
                            ->placeholder('Contoh: Program SD')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Program')
                            ->placeholder('Jelaskan detail program ini...')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil akan tampil lebih dulu di halaman depan.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Program')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}