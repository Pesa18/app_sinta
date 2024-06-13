<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanlokasiResource\Pages;
use App\Filament\Resources\PengaturanlokasiResource\RelationManagers;
use App\Models\Pengaturanlokasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanlokasiResource extends Resource
{
    protected static ?string $model = Pengaturanlokasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Lokasi';


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
            'index' => Pages\ListPengaturanlokasis::route('/'),
            'create' => Pages\CreatePengaturanlokasi::route('/create'),
            'edit' => Pages\EditPengaturanlokasi::route('/{record}/edit'),
        ];
    }
}
