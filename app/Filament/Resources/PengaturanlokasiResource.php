<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Masterlokasi;
use App\Models\Pengaturanlokasi;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\PengaturanlokasiResource\Pages;
use App\Filament\Resources\PengaturanlokasiResource\RelationManagers;
use App\Filament\Resources\PengaturanlokasiResource\RelationManagers\ArsipRelationManager;

class PengaturanlokasiResource extends Resource
{
    protected static ?string $model = Masterlokasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'lokasi';
    protected static ?string $pluralLabel = "pengaturan lokasi";
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Lokasi';

    public static function canDelete(Model $record): bool
    {
        if ($record->id < 2) {
            return false;
        }

        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lokasi')->label('Nama Lokasi')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('nama_lokasi')->label("Nama Lokasi")
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
            RelationManagers\ArsipRelationManager::class
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
