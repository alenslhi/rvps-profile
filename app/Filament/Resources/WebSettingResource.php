<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebSettingResource\Pages;
use App\Filament\Resources\WebSettingResource\RelationManagers;
use App\Models\WebSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebSettingResource extends Resource
{
    protected static ?string $model = WebSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Landing Page Banner')
                    ->description('Teks utama yang pertama kali dilihat pengunjung.')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('hero_judul')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Misal: Creative Thinker, Tech Enthusiast, & Lifelong Learner')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\TextInput::make('hero_subjudul')
                            ->maxLength(255)
                            ->placeholder('Kalimat pendukung singkat...')
                            ->columnSpanFull(),
                    ]),

                \Filament\Forms\Components\Section::make('Identitas Visual (Logo RVPS)')
                    ->description('Upload logo untuk menyesuaikan dengan tema terang dan gelap.')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('logo_terang')
                            ->label('Logo Mode Terang (Background Putih)')
                            ->image()
                            ->directory('web-settings')
                            ->maxSize(1024)
                            ->helperText('Gunakan gambar PNG dengan warna gelap (seperti hitam/orens pekat).'),
                        
                        \Filament\Forms\Components\FileUpload::make('logo_gelap')
                            ->label('Logo Mode Gelap (Background Hitam)')
                            ->image()
                            ->directory('web-settings')
                            ->maxSize(1024)
                            ->helperText('Gunakan gambar PNG dengan warna terang (seperti putih/orens terang).'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('hero_judul')
                    ->label('Judul Aktif Saat Ini')
                    ->weight('bold')
                    ->searchable(),
                \Filament\Tables\Columns\ImageColumn::make('logo_terang')
                    ->label('Preview Logo'),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y, H:i')
                    ->label('Terakhir Diperbarui'),
            ])
            ->filters([])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Kita hilangkan opsi hapus massal, karena pengaturan website tidak boleh dihapus sembarangan
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
            'index' => Pages\ListWebSettings::route('/'),
            'create' => Pages\CreateWebSetting::route('/create'),
            'edit' => Pages\EditWebSetting::route('/{record}/edit'),
        ];
    }
}
