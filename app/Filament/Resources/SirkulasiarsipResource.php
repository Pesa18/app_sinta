<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Dataarsip;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Models\Sirkulasiarsip;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Gate;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Infolists\Components\Group;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SirkulasiarsipResource\Pages;
use Filament\Infolists\Components\Section as InfoListSection;
use App\Filament\Resources\SirkulasiarsipResource\RelationManagers;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

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
                        ->relationship(name: 'arsipId', titleAttribute: 'nama_arsip', modifyQueryUsing: function (Builder $query) {
                            if (Gate::allows('akses-global-search')) {
                                return $query->where('arsip_pegawai_id', null)->limit(20);
                            } else {
                                return $query->where('arsip_pegawai_id', null)->where('user_id', auth()->id())->limit(20);
                            }
                        },)
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->nama_arsip} - {$record->noarsip}")
                        ->label('Pilih Arsip')
                        ->placeholder("Cari Berdasarkan No Arsip atau Nama Arsip ")
                        ->required()
                        ->validationMessages([
                            'required' => 'Pilih Arsip!',
                        ])->live()
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', $state);
                        }),
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
                TextColumn::make('userId.name')->label('User Peminjam')->badge(),
                TextColumn::make('tgl_pinjam')->label('Tanggal Pinjam'),
                TextColumn::make('tgl_pengembalian')->label('Tanggal Pengembalian')->state(function ($record) {
                    if ($record->tgl_pengembalian == null) {
                        return "Belum di Kembalikan";
                    }
                    return $record->tgl_pengembalian;
                })->badge()->color(fn (string $state): string => match ($state) {
                    "Belum di Kembalikan" => 'danger',
                    $state => 'success',
                })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Kembalikan')->label("Kembalikan")
                    ->button()->hidden(fn (Sirkulasiarsip $record) => $record->tgl_pengembalian)
                    ->icon('heroicon-o-arrow-path')
                    ->requiresConfirmation()->modalIcon('heroicon-o-arrow-path')
                    ->action(fn (Sirkulasiarsip $record) => $record->update(['tgl_pengembalian' => Carbon::today()->toDateString()])),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Group::make()->schema([
                    InfoListSection::make()->schema([
                        TextEntry::make('arsipId.nama_arsip')->label('Nama Arsip'),
                        TextEntry::make('userId.name')->label('User Peminjam'),
                        TextEntry::make('tgl_pinjam')->label('Tanggal Pinjam'),
                        TextEntry::make('tgl_expire')->label('Harus dikembalikan'),
                        TextEntry::make('tgl_pengembalian')->default('Belum Di Kembalikan'),
                        TextEntry::make('keperluan'),
                    ])->columns(2)
                ])->columns(2),

                PdfViewerEntry::make('arsipId.file_arsip')
                    ->label('View the PDF')
                    ->minHeight('50svh')

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
            'view' => Pages\ViewSirkulasi::route('/{record}'),
            'edit' => Pages\EditSirkulasiarsip::route('/{record}/edit'),
        ];
    }
}
