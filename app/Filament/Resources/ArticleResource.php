<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Konten Artikel')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('judul')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->disabled()
                                    ->dehydrated()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                // THE RICH TEXT EDITOR
                                \Filament\Forms\Components\RichEditor::make('konten')
                                    ->required()
                                    ->fileAttachmentsDirectory('article-images') // Gambar dalam artikel disimpan rapi
                                    ->columnSpanFull()
                                    ->toolbarButtons([ // Tombol yang penting buat nulis tutorial
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock', // Wajib ada buat developer!
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'undo',
                                    ]),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Pengaturan & Publikasi')
                            ->schema([
                                \Filament\Forms\Components\FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('article-thumbnails')
                                    ->required()
                                    ->columnSpanFull(),

                                \Filament\Forms\Components\Select::make('kategori')
                                    ->options([
                                        'Tutorial Laravel' => 'Tutorial Laravel',
                                        'Tips Android' => 'Tips Android',
                                        'Opini IT' => 'Opini IT',
                                        'Cerita Kampus' => 'Cerita Kampus',
                                    ])
                                    ->native(false)
                                    ->required(),

                                \Filament\Forms\Components\TextInput::make('estimasi_waktu_baca')
                                    ->numeric()
                                    ->suffix('menit')
                                    ->placeholder('Misal: 5'),

                                \Filament\Forms\Components\Toggle::make('is_published')
                                    ->label('Publikasikan?')
                                    ->default(false)
                                    ->inline(false) // Tampil lebih menonjol
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('thumbnail')
                    ->square(), // Tampilan gambar thumbnail kotak
                
                \Filament\Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(40) // Biar judul panjang gak merusak layout tabel
                    ->weight('bold'),

                \Filament\Tables\Columns\TextColumn::make('kategori')
                    ->badge(),

                \Filament\Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->label('Tanggal Dibuat'),
            ])
            ->filters([
                // Filter untuk melihat artikel yang dipublish/draft
                \Filament\Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi'),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
