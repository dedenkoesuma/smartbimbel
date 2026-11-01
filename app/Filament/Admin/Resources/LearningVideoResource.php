<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LearningVideoResource\Pages;
use App\Models\LearningVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class LearningVideoResource extends Resource
{
    protected static ?string $model = LearningVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';
    protected static ?string $navigationGroup = 'Halaman Video Belajar';
    protected static ?string $navigationLabel = 'Video Pembelajaran';
    protected static ?string $pluralModelLabel = 'Video Pembelajaran';
    protected static ?string $modelLabel = 'Video Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pembahasan Soal / Materi')
                    ->description('Masukkan judul pembahasan soal, mata pelajaran, jenjang, dan ringkasan materi.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Video / Pembahasan Soal')
                            ->placeholder('Contoh: Trik Cepat Penalaran Matematika UTBK 2026 — Soal Perbandingan')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug (URL Unik)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('category')
                            ->label('Mata Pelajaran / Kategori')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Matematika, Fisika, UTBK & SNBT, Bahasa Inggris')
                            ->datalist([
                                'UTBK & SNBT',
                                'Matematika',
                                'Fisika',
                                'Kimia',
                                'Biologi',
                                'Bahasa Inggris',
                                'TPS Penalaran',
                                'Ekonomi & Soshum',
                                'IPAS & Sains',
                            ]),

                        Select::make('grade_level')
                            ->label('Jenjang Pendidikan')
                            ->options([
                                'SD' => 'SD',
                                'SMP' => 'SMP',
                                'SMA' => 'SMA',
                                'UTBK & SNBT' => 'UTBK & SNBT',
                                'Bahasa Inggris' => 'Bahasa Inggris / Umum',
                                'Semua Jenjang' => 'Semua Jenjang',
                            ])
                            ->default('SMA')
                            ->searchable(),

                        TextInput::make('tutor_name')
                            ->label('Nama Pengajar / Tutor')
                            ->placeholder('Contoh: Kak Raka (Tutor Matematika)')
                            ->maxLength(150),

                        TextInput::make('duration')
                            ->label('Durasi Video')
                            ->placeholder('Contoh: 05:30 atau 6 Menit')
                            ->maxLength(50),

                        Textarea::make('description')
                            ->label('Deskripsi Singkat / Catatan Pembahasan Soal')
                            ->placeholder('Tuliskan ringkasan soal atau konsep penting yang dibahas di dalam video ini...')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Sumber Video & Thumbnail')
                    ->description('Pilih apakah ingin menempelkan link YouTube atau mengupload file video MP4 langsung dari perangkat.')
                    ->schema([
                        Radio::make('video_source')
                            ->label('Metode Input Video')
                            ->options([
                                'youtube' => 'Link YouTube (Rekomendasi — Cepat & Hemat Penyimpanan Hosting)',
                                'upload' => 'Upload File Video Langsung (MP4 / WebM dari Perangkat)',
                            ])
                            ->default('youtube')
                            ->required()
                            ->live()
                            ->columnSpanFull(),

                        TextInput::make('youtube_url')
                            ->label('Link Video YouTube')
                            ->placeholder('Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ atau https://youtu.be/...')
                            ->helperText('Mendukung link YouTube biasa, link Share (youtu.be), maupun YouTube Shorts.')
                            ->url()
                            ->visible(fn (Get $get): bool => $get('video_source') === 'youtube')
                            ->required(fn (Get $get): bool => $get('video_source') === 'youtube')
                            ->columnSpanFull(),

                        SpatieMediaLibraryFileUpload::make('video_file')
                            ->label('Upload File Video (MP4 / WebM)')
                            ->collection('video_file')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                            ->maxSize(102400) // Maks 100 MB
                            ->helperText('Format yang didukung: MP4, WebM, MOV (Maksimal 100 MB). Cocok untuk potongan video pendek pembahasan soal.')
                            ->visible(fn (Get $get): bool => $get('video_source') === 'upload')
                            ->required(fn (Get $get): bool => $get('video_source') === 'upload')
                            ->columnSpanFull(),

                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Gambar Cover / Thumbnail Video (Opsional untuk YouTube)')
                            ->collection('video_thumbnail')
                            ->image()
                            ->helperText('Jika menggunakan Link YouTube dan dikosongkan, sistem akan otomatis mengambil gambar cover dari YouTube. Jika upload file MP4, disarankan mengupload gambar cover agar tampilan lebih menarik.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan Publikasi')
                    ->schema([
                        DatePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->required(),

                        TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil akan ditampilkan lebih dulu.'),

                        Toggle::make('is_featured')
                            ->label('Jadikan Video Pilihan (Highlight Utama di Atas)?')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website?')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail_preview')
                    ->label('Cover')
                    ->state(fn (LearningVideo $record): string => $record->thumbnail_url)
                    ->width(96)
                    ->height(54)
                    ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 8px;']),

                TextColumn::make('title')
                    ->label('Judul Pembahasan')
                    ->searchable()
                    ->limit(42)
                    ->description(fn (LearningVideo $record): string => collect([$record->grade_level, $record->tutor_name])->filter()->join(' • ')),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),

                TextColumn::make('video_source')
                    ->label('Sumber')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'youtube' ? 'YouTube' : 'File Upload')
                    ->color(fn (string $state): string => $state === 'youtube' ? 'danger' : 'info'),

                TextColumn::make('duration')
                    ->label('Durasi')
                    ->placeholder('-'),

                IconColumn::make('is_featured')
                    ->label('Highlight')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('video_source')
                    ->label('Sumber Video')
                    ->options([
                        'youtube' => 'Link YouTube',
                        'upload' => 'Upload File MP4',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Tampil'),
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
            'index'  => Pages\ListLearningVideos::route('/'),
            'create' => Pages\CreateLearningVideo::route('/create'),
            'edit'   => Pages\EditLearningVideo::route('/{record}/edit'),
        ];
    }
}
