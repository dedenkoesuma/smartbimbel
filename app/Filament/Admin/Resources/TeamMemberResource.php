<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeamMemberResource\Pages;
use App\Filament\Admin\Resources\TeamMemberResource\RelationManagers;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Halaman Tentang Kami';

  public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Staf/Tutor')
                    ->required()
                    ->maxLength(255),
                    
                TextInput::make('position')
                    ->label('Jabatan (Contoh: Kepala Akademik)')
                    ->required()
                    ->maxLength(255),
                    
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Foto Profil')
                    ->collection('team_images')
                    ->columnSpanFull(),
                    
                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
                    
                Toggle::make('is_active')
                    ->label('Aktif (Tampilkan di Web?)')
                    ->default(true),
            ]);
    }

  public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto')
                    ->collection('team_images')
                    ->circular(), // Bikin fotonya bulat di tabel
                    
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                    
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),
                    
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                    
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
