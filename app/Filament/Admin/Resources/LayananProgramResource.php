<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LayananProgramResource\Pages;
use App\Models\LayananProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class LayananProgramResource extends Resource
{
    protected static ?string $model = LayananProgram::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Halaman Layanan';
    protected static ?string $navigationLabel = 'Program Utama';
    protected static ?string $pluralModelLabel = 'Program Utama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Info Program Utama')->schema([
                Forms\Components\TextInput::make('badge')
                    ->label('Badge')
                    ->placeholder('Contoh: Program SD'),
                Forms\Components\TextInput::make('title')
                    ->label('Judul Program')
                    ->required()
                    ->placeholder('Contoh: Program Sekolah Dasar'),
                Forms\Components\TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->placeholder('Contoh: Untuk kelas 1-6 SD'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->placeholder('Contoh: Fokus membangun fondasi berhitung...')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Checklist & Foto Program')->schema([
                Forms\Components\Repeater::make('checklists')
                    ->label('Poin-poin Checklist')
                    ->schema([
                        Forms\Components\TextInput::make('point')
                            ->label('Isi Poin')
                            ->placeholder('Contoh: Matematika & calistung dasar')
                            ->required(),
                    ])
                    ->grid(2)
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('layanan_program')
                    ->label('Foto Program')
                    ->required()
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')->collection('layanan_program')->label('Foto'),
            Tables\Columns\TextColumn::make('badge')->label('Badge')->searchable(),
            Tables\Columns\TextColumn::make('title')->label('Judul Program')->searchable()->weight('bold'),
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
            'index' => Pages\ListLayananPrograms::route('/'),
            'create' => Pages\CreateLayananProgram::route('/create'),
            'edit' => Pages\EditLayananProgram::route('/{record}/edit'),
        ];
    }
}