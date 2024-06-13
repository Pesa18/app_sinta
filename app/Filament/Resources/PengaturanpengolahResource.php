<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanpengolahResource\Pages;
use App\Filament\Resources\PengaturanpengolahResource\RelationManagers;
use App\Models\Pengaturanpengolah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanpengolahResource extends Resource
{
    protected static ?string $model = Pengaturanpengolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengolah';


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
            'index' => Pages\ListPengaturanpengolahs::route('/'),
            'create' => Pages\CreatePengaturanpengolah::route('/create'),
            'edit' => Pages\EditPengaturanpengolah::route('/{record}/edit'),
        ];
    }
}
