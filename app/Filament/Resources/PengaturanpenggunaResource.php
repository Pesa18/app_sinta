<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanpenggunaResource\Pages;
use App\Filament\Resources\PengaturanpenggunaResource\RelationManagers;
use App\Models\Pengaturanpengguna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanpenggunaResource extends Resource
{
    protected static ?string $model = Pengaturanpengguna::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengguna';


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
            'index' => Pages\ListPengaturanpenggunas::route('/'),
            'create' => Pages\CreatePengaturanpengguna::route('/create'),
            'edit' => Pages\EditPengaturanpengguna::route('/{record}/edit'),
        ];
    }
}
