<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactMessageResource\Pages;
use App\Filament\Admin\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Data Masuk';
    protected static ?string $navigationLabel = 'Pesan Kontak';
    protected static ?string $pluralModelLabel = 'Pesan Kontak';
    protected static ?string $modelLabel = 'Pesan Kontak';
    public static function canCreate(): bool
    {
        return false;
    }
   public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Pengirim')
                    ->disabled(), // Dikunci agar admin tidak bisa edit nama
                    
                TextInput::make('phone')
                    ->label('Nomor Telepon/WA')
                    ->disabled(),
                    
                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
                    
                TextInput::make('program_interest')
                    ->label('Program yang Diminati')
                    ->disabled(),
                    
                Textarea::make('message')
                    ->label('Isi Pesan')
                    ->disabled()
                    ->columnSpanFull(),
                    
                Select::make('status')
                    ->label('Status Follow-up')
                    ->options([
                        'baru' => 'Baru Masuk',
                        'dihubungi' => 'Sedang Dihubungi',
                        'selesai' => 'Selesai / Deal',
                    ])
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                    
                TextColumn::make('phone')
                    ->label('No. Telepon')
                    ->searchable(),
                    
                TextColumn::make('program_interest')
                    ->label('Minat Program'),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baru' => 'danger',
                        'dihubungi' => 'warning',
                        'selesai' => 'success',
                        default => 'gray',
                    }),
                    
                TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('message')
                ->label('Isi Pesan')
                ->limit(50) 
                ->searchable()
                ->wrap(),
            ])
            ->defaultSort('created_at', 'desc') // Urutkan dari pesan terbaru
            ->filters([
                //
            ])
            ->actions([
               Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(function ($record) {
                        $phone = preg_replace('/[^0-9]/', '', $record->phone);

                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        } elseif (! str_starts_with($phone, '62')) {
                            $phone = '62' . $phone;
                        }

                        if ($record->program_interest) {
                            $konteks = "soal {$record->program_interest}";
                        } else {
                            $konteks = "terkait pertanyaan: \"{$record->message}\"";
                        }

                        $pesan = "Halo kak {$record->name}, saya dari Bimbel Smart mau menindaklanjuti pesan kakak {$konteks}. Ada yang bisa kami bantu?";

                        return 'https://wa.me/' . $phone . '?text=' . urlencode($pesan);
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
