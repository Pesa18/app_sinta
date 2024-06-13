<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanklasifikasiResource\Pages;
use App\Filament\Resources\PengaturanklasifikasiResource\RelationManagers;
use App\Models\Pengaturanklasifikasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanklasifikasiResource extends Resource
{
    protected static ?string $model = Pengaturanklasifikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Klasifikasi';


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
            'index' => Pages\ListPengaturanklasifikasis::route('/'),
            'create' => Pages\CreatePengaturanklasifikasi::route('/create'),
            'edit' => Pages\EditPengaturanklasifikasi::route('/{record}/edit'),
        ];
    }
}
