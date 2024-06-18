<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Dataarsip;
use Filament\Tables\Table;
use App\Models\Mastermedia;
use App\Models\Masterlokasi;
use App\Models\Masterpencipta;
use App\Models\Masterpengolah;
use Filament\Resources\Resource;
use App\Models\Masterklasifikasi;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DataarsipResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DataarsipResource\RelationManagers;

class DataarsipResource extends Resource
{
    protected static ?string $model = Dataarsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Arsip';
    protected static ?string $slug = 'data-arsip';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->columns([
                    'sm' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])->schema([
                    TextInput::make('noarsip')->label('Nomor Arsip')->required(),
                    TextInput::make('nama_arsip')->label('Nama Arsip')->required(),
                    DatePicker::make('tanggal_arsip')->label('Tanggal Arsip')->native(false)->required()->placeholder(Carbon::now()->toFormattedDateString()),
                    Select::make('pencipta_id')
                        ->label('Pencipta')
                        ->options(Masterpencipta::all()->pluck('nama_pencipta', 'id'))
                        ->required()
                        ->placeholder('Pilih Pencipta'),
                    Select::make('pengolah_id')
                        ->label('Pengolah')
                        ->options(Masterpengolah::all()->pluck('nama_pengolah', 'id'))
                        ->required(),
                    Select::make('kode_id')
                        ->label('Klasifikasi')
                        ->options(Masterklasifikasi::all()->pluck('nama', 'id'))
                        ->required(),
                    Select::make('lokasi_id')
                        ->label('Lokasi Arsip')
                        ->options(Masterlokasi::all()->pluck('nama_lokasi', 'id'))
                        ->required(),
                    Select::make('media_id')
                        ->label('Media')
                        ->options(Mastermedia::all()->pluck('nama_media', 'id'))
                        ->required(),
                    Select::make('ket')
                        ->label('Keterangan Keaslian')
                        ->options([
                            'Asli' => 'Asli',
                            'Copy' => 'Copy'
                        ])
                        ->required(),
                    Textarea::make('uraian')->label('Uraian')
                        ->autosize(),
                    TextInput::make('jumlah_arsip')->label('Jumlah Arsip')->required(),
                    TextInput::make('no_box')->label('Nomor Box')->required(),
                    FileUpload::make('file_arsip')->required()



                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('noarsip')->label('No. Arsip'),
                TextColumn::make('nama_arsip')->label('Nama'),
                TextColumn::make('user.name')->label('User'),
                IconColumn::make('file_arsip')
                    ->icon('heroicon-s-qr-code')->action(Action::make('select')
                        ->requiresConfirmation())


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
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
            'index' => Pages\ListDataarsips::route('/'),
            'create' => Pages\CreateDataarsip::route('/create'),
            'edit' => Pages\EditDataarsip::route('/{record}'),
        ];
    }
}
