<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Artikel')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'tips'      => 'Tips Belajar',
                        'info'      => 'Info Pendidikan',
                        'sukses'    => 'Cerita Sukses',
                        'english'   => 'English Corner',
                        'parenting' => 'Parenting',
                    ])
                    ->required(),

                Textarea::make('excerpt')
                    ->label('Ringkasan Singkat')
                    ->required()
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Gambar Cover')
                    ->collection('post_images')
                    ->required()
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Isi Artikel')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('read_time')
                    ->label('Estimasi Waktu Baca (menit)')
                    ->numeric()
                    ->default(5)
                    ->required(),

                DatePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->default(now())
                    ->required(),

                Toggle::make('is_featured')
                    ->label('Jadikan Artikel Pilihan?')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Tampilkan di Website?')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Cover')
                    ->collection('post_images'),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge(),

                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label('Pilihan')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}   