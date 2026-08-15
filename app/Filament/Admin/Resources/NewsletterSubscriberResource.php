<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;
    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';
    protected static ?string $navigationGroup = 'Data Masuk';
    protected static ?string $navigationLabel = ' Newsletter';
    protected static ?string $pluralModelLabel = ' Newsletter';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('email')
                ->label('Alamat Email')
                ->searchable()
                ->copyable() // Bisa di-copy dengan sekali klik untuk dipindah ke platform email marketing
                ->copyMessage('Email disalin!'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Berlangganan')
                ->dateTime('d M Y, H:i')
                ->sortable(),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\DeleteAction::make(), // Hanya tombol Hapus
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
            // Hanya halaman list, tidak perlu halaman create/edit
            'index' => Pages\ListNewsletterSubscribers::route('/'),
        ];
    }
    
    // Matikan tombol "New" di halaman index
    public static function canCreate(): bool
    {
        return false;
    }
}