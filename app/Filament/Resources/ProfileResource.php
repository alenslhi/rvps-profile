<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Group::make()
                    ->schema([
                        // BAGIAN 1: INFORMASI UTAMA
                        \Filament\Forms\Components\Section::make('Informasi Utama')
                            ->description('Identitas utama yang akan tampil di halaman depan.')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('nama_lengkap')
                                    ->required()
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('peran')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Misal: System Information Student & Creative'),
                                \Filament\Forms\Components\FileUpload::make('foto_profil')
                                    ->image()
                                    ->directory('profile-photos')
                                    ->maxSize(2048) // Maksimal 2MB
                                    ->columnSpanFull(),
                                \Filament\Forms\Components\Textarea::make('biodata_singkat')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ])->columns(2), // Membuat field sejajar 2 kolom

                        // BAGIAN 2: KONTAK & SOSIAL MEDIA
                        \Filament\Forms\Components\Section::make('Kontak & Sosial Media')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('whatsapp')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('Gunakan format 628...'),
                                \Filament\Forms\Components\TextInput::make('instagram')
                                    ->maxLength(255)
                                    ->prefix('https://instagram.com/'),
                                \Filament\Forms\Components\TextInput::make('github')
                                    ->maxLength(255)
                                    ->prefix('https://github.com/'),
                                \Filament\Forms\Components\TextInput::make('linkedin')
                                    ->maxLength(255)
                                    ->prefix('https://linkedin.com/in/'),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]), // Group ini mengambil 2/3 ruang layar di Desktop

                // BAGIAN 3: SIDEBAR (FILE & JSON DATA)
                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Dokumen')
                            ->schema([
                                \Filament\Forms\Components\FileUpload::make('file_cv')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('cv-files')
                                    ->label('Upload CV (PDF)'),
                            ]),

                        // Ini fitur andalan: Repeater untuk JSON!
                        \Filament\Forms\Components\Section::make('Riwayat & Keahlian')
                            ->schema([
                                \Filament\Forms\Components\Repeater::make('riwayat_pendidikan')
                                    ->schema([
                                        \Filament\Forms\Components\TextInput::make('institusi')->required(),
                                        \Filament\Forms\Components\TextInput::make('tahun')->required(),
                                        \Filament\Forms\Components\TextInput::make('jurusan'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['institusi'] ?? null)
                                    ->collapsed(), // Biar rapi, bisa di-minimize

                                \Filament\Forms\Components\Repeater::make('pengalaman_organisasi')
                                    ->schema([
                                        \Filament\Forms\Components\TextInput::make('nama_organisasi')->required(),
                                        \Filament\Forms\Components\TextInput::make('jabatan')->required(),
                                        \Filament\Forms\Components\TextInput::make('tahun')->required(),
                                    ])
                                    ->collapsed(),

                                \Filament\Forms\Components\Repeater::make('keahlian_umum')
                                    ->schema([
                                        \Filament\Forms\Components\TextInput::make('nama_skill')->required(),
                                        \Filament\Forms\Components\Select::make('level')
                                            ->options([
                                                'Beginner' => 'Beginner',
                                                'Intermediate' => 'Intermediate',
                                                'Expert' => 'Expert',
                                            ])->required(),
                                    ])
                                    ->collapsed(),
                            ]),
                    ])->columnSpan(['lg' => 1]), // Group ini mengambil 1/3 ruang layar (Sidebar)
            ])
            ->columns(3); // Total ada 3 kolom virtual
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('peran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto_profil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('github')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkedin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_cv')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
