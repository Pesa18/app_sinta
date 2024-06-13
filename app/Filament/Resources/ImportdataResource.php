<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Importdata;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Navigation\NavigationItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ImportdataResource\Pages;
use App\Filament\Resources\ImportdataResource\RelationManagers;

class ImportdataResource extends Resource
{
    protected static ?string $model = Importdata::class;

    protected static ?string $navigationIcon = 'heroicon-s-archive-box-arrow-down';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Import Data';





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
            'index' => Pages\ListImportdatas::route('/'),
            'create' => Pages\CreateImportdata::route('/create'),
            'edit' => Pages\EditImportdata::route('/{record}/edit'),
        ];
    }
}
