<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanpenciptaResource\Pages;
use App\Filament\Resources\PengaturanpenciptaResource\RelationManagers;
use App\Models\Masterpencipta;
use App\Models\Pengaturanpencipta;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanpenciptaResource extends Resource
{
    protected static ?string $model = Masterpencipta::class;
    protected static ?string $slug = 'pencipta';
    protected static ?string $pluralLabel = "pengaturan pencipta";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pencipta';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pencipta')->label('Nama Pencipta')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->label('No.')->rowIndex(),
                TextColumn::make('nama_pencipta')->label('Nama Pencipta'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPengaturanpenciptas::route('/'),
            'create' => Pages\CreatePengaturanpencipta::route('/create'),
            'edit' => Pages\EditPengaturanpencipta::route('/{record}/edit'),
        ];
    }
}
