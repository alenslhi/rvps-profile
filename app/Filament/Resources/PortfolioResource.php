<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Detail Kegiatan / Karya')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('judul')
                                    ->required()
                                    ->live(onBlur: true) // Otomatis mengisi slug saat kursor pindah
                                    ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                                    ->maxLength(255),
                                
                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->disabled() // User tidak perlu isi manual
                                    ->dehydrated() // Tapi tetap disimpan ke database
                                    ->maxLength(255),

                                \Filament\Forms\Components\Select::make('kategori')
                                    ->options([
                                        'Web Development' => 'Web Development',
                                        'Mobile App' => 'Mobile App',
                                        'Kegiatan Organisasi' => 'Kegiatan Organisasi',
                                        'Multimedia & Desain' => 'Multimedia & Desain',
                                    ])
                                    ->required()
                                    ->native(false), // Tampilan dropdown yang lebih modern

                                \Filament\Forms\Components\Textarea::make('deskripsi_singkat')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->placeholder('Ceritakan sedikit tentang proyek atau kegiatan ini...'),
                            ])->columns(2),

                        \Filament\Forms\Components\Section::make('Tools & Tautan')
                            ->schema([
                                \Filament\Forms\Components\TagsInput::make('tools_digunakan')
                                    ->placeholder('Misal: Laravel, Figma, Premiere Pro (Ketik lalu Enter)')
                                    ->separator(',')
                                    ->columnSpanFull(),
                                
                                \Filament\Forms\Components\TextInput::make('link_eksternal')
                                    ->url()
                                    ->placeholder('https://github.com/... atau link YouTube')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                \Filament\Forms\Components\Group::make()
                    ->schema([
                        // THE MASTER GALLERY UPLOADER
                        \Filament\Forms\Components\Section::make('Galeri Visual')
                            ->description('Upload foto-foto kegiatan atau *screenshot* karya di sini.')
                            ->schema([
                                \Filament\Forms\Components\FileUpload::make('galeri_foto')
                                    ->multiple() // Kunci utamanya: bisa banyak foto!
                                    ->image()
                                    ->reorderable() // Bisa geser urutan foto
                                    ->appendFiles()
                                    ->directory('portfolio-gallery')
                                    ->maxFiles(5) // Batasi 5 foto agar tidak terlalu berat
                                    ->panelLayout('grid')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->weight('bold'),
                \Filament\Tables\Columns\TextColumn::make('kategori')
                    ->badge() // Membuatnya tampil seperti "pil" berwarna
                    ->color(fn (string $state): string => match ($state) {
                        'Web Development' => 'info',
                        'Mobile App' => 'success',
                        'Kegiatan Organisasi' => 'warning',
                        'Multimedia & Desain' => 'danger',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Kita tambahkan filter kategori nanti jika datanya sudah banyak
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
