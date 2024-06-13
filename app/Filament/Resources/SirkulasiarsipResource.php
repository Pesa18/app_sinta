<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SirkulasiarsipResource\Pages;
use App\Filament\Resources\SirkulasiarsipResource\RelationManagers;
use App\Models\Sirkulasiarsip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SirkulasiarsipResource extends Resource
{
    protected static ?string $model = Sirkulasiarsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Data Arsip';
    protected static ?string $navigationLabel = 'Sirkulasi Arsip';


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
            'index' => Pages\ListSirkulasiarsips::route('/'),
            'create' => Pages\CreateSirkulasiarsip::route('/create'),
            'edit' => Pages\EditSirkulasiarsip::route('/{record}/edit'),
        ];
    }
}
