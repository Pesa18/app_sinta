<?php

namespace App\Filament\Resources\ArsippegawaiResource\Pages;

use App\Filament\Resources\ArsippegawaiResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArsiprelatedRecord extends ManageRelatedRecords
{
    protected static string $resource = ArsippegawaiResource::class;

    protected static string $relationship = 'pegawai';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public  function getTitle(): string
    {
        return ' Data Arsip Pegawai';
    }
    public static function getNavigationLabel(): string
    {
        return 'Arsip Pegawai';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_arsip')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_arsip')
            ->columns([
                Tables\Columns\TextColumn::make('nama_arsip'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
