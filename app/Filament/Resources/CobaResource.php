<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CobaResource\Pages;
use App\Filament\Resources\CobaResource\RelationManagers;
use App\Models\Masterkode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CobaResource extends Resource
{
    protected static ?string $model = Masterkode::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Shop';
    protected static ?string $navigationLabel = 'Mis Clientes';
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
                TextColumn::make('kode')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCobas::route('/'),
            'create' => Pages\CreateCoba::route('/create'),
            'view' => Pages\ViewCoba::route('/{record}'),
            'edit' => Pages\EditCoba::route('/{record}/edit'),
        ];
    }
}
