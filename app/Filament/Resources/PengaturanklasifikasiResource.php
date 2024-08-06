<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Masterklasifikasi;
use App\Models\Pengaturanklasifikasi;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengaturanklasifikasiResource\Pages;
use App\Filament\Resources\PengaturanklasifikasiResource\RelationManagers;

class PengaturanklasifikasiResource extends Resource
{
    protected static ?string $model = Masterklasifikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;
    protected static ?string $slug = 'klasifikasi';
    protected static ?string $pluralLabel = "Pengaturan Klasifikasi";
    protected static ?string $navigationLabel = 'Klasifikasi';
    public static function canDelete(Model $record): bool
    {
        if ($record->id < 3) {
            return false;
        }

        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required()->label('Nama Klasifikasi'),
                TextInput::make('kode')->required()->label('Kode'),
                ToggleButtons::make('retensi')
                    ->label('Retensi Arsip')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',

                    ])
                    ->colors([
                        0 => 'danger',
                        1 => 'success',
                    ])
                    ->icons([
                        0 => 'heroicon-o-x-circle',
                        1 => 'heroicon-o-check-circle'
                    ])
                    ->grouped()->default(1)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama Klasifikasi'),
                TextColumn::make('kode')->label('kode'),
                TextColumn::make('retensi')->label('Retensi')->badge()->state(function ($record) {
                    if ($record->retensi && $record->retensi > 0) {
                        return "Aktif";
                    } else {
                        return "Tidak Aktif";
                    }
                })
                    ->color(fn (string $state): string => match ($state) {
                        "Aktif" => 'success',
                        "Tidak Aktif" => 'danger',
                    })->icon(fn (string $state): string => match ($state) {
                        "Aktif" => 'heroicon-o-check-circle',
                        "Tidak Aktif" => 'heroicon-o-x-circle',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn (Model $record): bool => $record->id < 3 ? false : true),
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
            'index' => Pages\ListPengaturanklasifikasis::route('/'),
            'create' => Pages\CreatePengaturanklasifikasi::route('/create'),
            'edit' => Pages\EditPengaturanklasifikasi::route('/{record}/edit'),
        ];
    }
}
