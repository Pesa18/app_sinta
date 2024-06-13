<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanpenciptaResource\Pages;
use App\Filament\Resources\PengaturanpenciptaResource\RelationManagers;
use App\Models\Pengaturanpencipta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanpenciptaResource extends Resource
{
    protected static ?string $model = Pengaturanpencipta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pencipta';


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
            'index' => Pages\ListPengaturanpenciptas::route('/'),
            'create' => Pages\CreatePengaturanpencipta::route('/create'),
            'edit' => Pages\EditPengaturanpencipta::route('/{record}/edit'),
        ];
    }
}
