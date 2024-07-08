<?php

namespace App\Filament\Resources;

use Closure;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Dataarsip;
use Illuminate\View\View;
use Filament\Tables\Table;
use App\Models\Mastermedia;
use App\Models\Masterlokasi;
use App\Models\Masterpencipta;
use App\Models\Masterpengolah;
use BaconQrCode\Encoder\QrCode;
use Filament\Resources\Resource;
use App\Models\Masterklasifikasi;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Navigation\NavigationItem;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;
use App\Filament\Resources\DataarsipResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DataarsipResource\Pages\DetailUser;
use App\Filament\Resources\DataarsipResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DataarsipResource extends Resource
{
    protected static ?string $model = Dataarsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Arsip';
    protected static ?string $slug = 'data-arsip';
    protected static ?string $label = 'Arsip';
    protected static ?string $pluralLabel = "Data Arsip";
    protected static ?int $navigationSort = 3;


    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->parentItem(static::getNavigationParentItem())
                ->icon(static::getNavigationIcon())
                ->activeIcon(static::getActiveNavigationIcon())
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.*'))
                ->badge(static::getNavigationBadge(), color: static::getNavigationBadgeColor())
                ->badgeTooltip(static::getNavigationBadgeTooltip())
                ->sort(static::getNavigationSort())
                ->url(static::getNavigationUrl())
                ->hidden(fn (): bool => auth()->user()->can('data-arsip')),
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->columns([
                    'sm' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])->schema([
                    TextInput::make('noarsip')->label('Nomor Arsip')->rule('required')->markAsRequired(true)->validationMessages([
                        'required' => 'No Arsip harus diisi.',
                    ]),
                    TextInput::make('nama_arsip')->label('Nama Arsip')->rule('required')->markAsRequired(true)->validationMessages([
                        'required' => 'Nama Arsip harus diisi.',
                    ]),
                    DatePicker::make('tanggal_arsip')->label('Tanggal Arsip')->native(false)->placeholder(Carbon::now()->toFormattedDateString())->required()->validationMessages([
                        'required' => 'Tanggal Arsip harus diisi.',
                    ]),
                    Select::make('pencipta_id')
                        ->relationship(name: 'Pencipta', titleAttribute: 'nama_pencipta')->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Pencipta harus diisi.',
                        ])->placeholder('Pilih Pencipta')->native(false),
                    Select::make('pengolah_id')
                        ->label('Pengolah')
                        ->relationship(name: 'Pengolah', titleAttribute: 'nama_pengolah')
                        ->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Pengolah harus diisi.',
                        ])->placeholder('Pilih Pencipta')->native(false),
                    Select::make('kode_id')
                        ->label('Klasifikasi')
                        ->relationship(name: 'Kode', titleAttribute: 'nama')
                        ->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Klasifikasi harus diisi.',
                        ])->placeholder('Pilih Pencipta')->native(false),
                    Select::make('lokasi_id')
                        ->label('Lokasi Arsip')
                        ->relationship(name: 'Lokasi', titleAttribute: 'nama_lokasi')
                        ->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Lokasi harus diisi.',
                        ])->placeholder('Pilih Pencipta')->native(false),
                    Select::make('media_id')
                        ->label('Media')
                        ->relationship(name: 'Media', titleAttribute: 'nama_media')
                        ->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Media harus diisi.',
                        ])->placeholder('Pilih Pencipta')->native(false),
                    Select::make('ket')
                        ->label('Keterangan Keaslian')
                        ->options([
                            'Asli' => 'Asli',
                            'Copy' => 'Copy'
                        ])->placeholder('Pilih Pencipta')->native(false)
                        ->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Keterangan harus diisi.',
                        ]),
                    Textarea::make('uraian')->label('Uraian')
                        ->autosize()->rule('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Uraian harus diisi.',
                        ]),
                    TextInput::make('jumlah_arsip')->numeric()->label('Jumlah Arsip')->rule('required')->markAsRequired(true)->validationMessages([
                        'required' => 'Jumlah harus diisi.',
                    ]),
                    TextInput::make('no_box')->label('Nomor Box')->rule('required')->markAsRequired(true)->validationMessages([
                        'required' => 'No Box harus diisi.',
                    ]),
                    FileUpload::make('file_arsip')->acceptedFileTypes(['application/pdf'])->directory(function (Get $get) {
                        return $get('no_box') . "_" . Carbon::parse($get('tanggal_arsip'))->format('dmY');
                    })->required()->validationMessages([
                        'required' => 'File harus diisi.',
                    ])->getUploadedFileNameForStorageUsing(
                        fn (Get $get, TemporaryUploadedFile $file): string => (string) str(str_replace(' ', '_', $get('nama_arsip')) . "." . $file->getClientOriginalExtension()),
                    ),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('noarsip')->label('No. Arsip')->searchable(),
                TextColumn::make('nama_arsip')->label('Nama Arsip')->searchable(),
                TextColumn::make('user.name')->label('User')->badge()->color('success'),
                TextColumn::make('tanggal_arsip'),
                ColumnGroup::make('File', [
                    IconColumn::make('file_arsip')->label('File')->icon('heroicon-s-document')->url(fn (Dataarsip $record): string => url($record->file_arsip))
                        ->openUrlInNewTab(),
                    IconColumn::make('')->icon('heroicon-s-qr-code')->label('QR')->state(function ($record) {
                        return $record->file_arsip;
                    })->action(Action::make('qr')->modalContent(
                        fn (Dataarsip $record): View => view('modal', ['data' => Qr::size(200)->generate(url($record->file_arsip))])
                    )->modalSubmitAction(false)->modalWidth(MaxWidth::Large)->modalCancelAction(false)->extraModalFooterActions(fn (Action $action): array => [
                        $action->url(fn (Dataarsip $record): string => url($record->file_arsip))->openUrlInNewTab()->label('Buka Url'),
                    ]))
                ]),
            ])
            ->filters([
                //
            ])->modifyQueryUsing(function (Builder $query) {
                return  $query->where('arsip_pegawai_id', NULL);
            })
            ->actions([
                Action::make('Detail')->label('Detail')->url(fn (Dataarsip $record): string => route('filament.admin.resources.data-arsip.detail-user', $record)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('hapus')->modalHeading('asjkdahsd')->modalDescription('Yakin mau menghapus ini?')->after(function (Dataarsip $record) {
                    // delete single
                    if ($record->file_arsip) {
                        Storage::disk('public')->delete($record->file_arsip);
                    }
                    // // delete multiple
                    // if ($record->galery) {
                    //     foreach ($record->galery as $ph) Storage::disk('public')->delete($ph);
                    // }
                }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Pilihan')->after(fn (Collection $records) => $records->each(fn (Dataarsip $record) => Storage::disk('public')->delete($record->file_arsip))),
                ])->label('Aksi'),
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
            'view' => Pages\ViewUser::route('/{record}/view'),
            'detail-user' => Pages\DetailArsip::route('/{record}/detail'),
            'edit' => Pages\EditDataarsip::route('/{record}'),
        ];
    }
}
