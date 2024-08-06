<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanpengolahResource\Pages;
use App\Filament\Resources\PengaturanpengolahResource\RelationManagers;
use App\Models\Masterpengolah;
use App\Models\Pengaturanpengolah;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanpengolahResource extends Resource
{
    protected static ?string $model = Masterpengolah::class;
    protected static ?string $slug = 'pengolah';
    protected static ?string $pluralLabel = "Pengaturan Pengolah";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengolah';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pengolah')->label('Nama Pengolah')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('')->label('No')->rowIndex(),
                TextColumn::make("nama_pengolah")->label('Nama Pengolah')
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
