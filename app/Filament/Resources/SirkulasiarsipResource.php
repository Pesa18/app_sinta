<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Dataarsip;
use Filament\Tables\Table;
use App\Models\Sirkulasiarsip;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SirkulasiarsipResource\Pages;
use App\Filament\Resources\SirkulasiarsipResource\RelationManagers;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class SirkulasiarsipResource extends Resource
{
    protected static ?string $model = SirkulasiArsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Data Arsip';
    protected static ?string $navigationLabel = 'Sirkulasi Arsip';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('arsip_id')
                        ->searchable(['noarsip', 'nama_arsip'])
                        ->relationship(name: 'arsipId', titleAttribute: 'nama_arsip', modifyQueryUsing: fn (Builder $query) => $query->limit(10),)
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->nama_arsip} - {$record->noarsip}")
                        ->label('Pilih Arsip')
                        ->placeholder("Cari Berdasarkan No Arsip atau Nama Arsip ")
                        ->required()
                        ->validationMessages([
                            'required' => 'Pilih Arsip!',
                        ]),
                    Select::make('user_id')
                        ->searchable('name')
                        ->relationship(name: 'userId', titleAttribute: 'name', modifyQueryUsing: fn (Builder $query) => $query->limit(10),)
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name}")
                        ->label('Pilih User')
                        ->placeholder("Cari User Peminjam ")
                        ->required()
                        ->validationMessages([
                            'required' => 'Pilih User!',
                        ]),
                    DatePicker::make('tgl_pinjam')->label('Tanggal Pinjam')->native(false)->placeholder(Carbon::now()->toFormattedDateString())->required()->validationMessages([
                        'required' => 'Tanggal Pinjam harus diisi.',
                    ]),
                    DatePicker::make('tgl_expire')->label('Tanggal Kadaluarsa')->native(false)->placeholder(Carbon::now()->toFormattedDateString())->required()->validationMessages([
                        'required' => 'Tanggal Kadaluarsa harus diisi.',
                    ]),
                    Textarea::make('keperluan')->label('Keperluan')->autosize()->required()->validationMessages([
                        'required' => 'Keperluan harus diisi.',
                    ]),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('arsipId.nama_arsip')->label('Nama Arsip'),
                TextColumn::make('userId.name')->label('User Peminjam')->badge()
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
            'index' => Pages\ListSirkulasiarsips::route('/'),
            'create' => Pages\CreateSirkulasiarsip::route('/create'),
            'edit' => Pages\EditSirkulasiarsip::route('/{record}/edit'),
        ];
    }
}
