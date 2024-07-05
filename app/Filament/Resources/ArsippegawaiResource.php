<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArsippegawaiResource\Pages;
use App\Filament\Resources\ArsippegawaiResource\RelationManagers;
use App\Models\Arsippegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArsippegawaiResource extends Resource
{
    protected static ?string $model = ArsipPegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Data Arsip';
    protected static ?string $navigationLabel = 'Arsip Pegawai';
    protected static ?string $slug = 'data-pegawai';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListArsippegawais::route('/'),
            'create' => Pages\CreateArsippegawai::route('/create'),
            'edit' => Pages\EditArsippegawai::route('/{record}/edit'),
        ];
    }
}
