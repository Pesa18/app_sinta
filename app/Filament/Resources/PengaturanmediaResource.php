<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanmediaResource\Pages;
use App\Filament\Resources\PengaturanmediaResource\RelationManagers;
use App\Models\Mastermedia;
use App\Models\Pengaturanmedia;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanmediaResource extends Resource
{
    protected static ?string $model = Mastermedia::class;
    protected static ?string $slug = 'media';
    protected static ?string $pluralLabel = "Pengaturan Media";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Media';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_media')->label('Nama Media')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->label('No.')->rowIndex(),
                TextColumn::make('nama_media')->label('Nama Media')
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
            'index' => Pages\ListPengaturanmedia::route('/'),
            'create' => Pages\CreatePengaturanmedia::route('/create'),
            'edit' => Pages\EditPengaturanmedia::route('/{record}/edit'),
        ];
    }
}
