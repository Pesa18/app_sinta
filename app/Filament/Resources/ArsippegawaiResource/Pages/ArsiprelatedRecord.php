<?php

namespace App\Filament\Resources\ArsippegawaiResource\Pages;

use Carbon\Carbon;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Dataarsip;
use Illuminate\View\View;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Group;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\ArsippegawaiResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Forms\Components\Section as FormSection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

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
                FormSection::make()->columns([
                    'sm' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])->schema([

                    TextInput::make('user_id')->hidden(),
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
                ])
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([
                Group::make()->schema([
                    Section::make()->schema([
                        TextEntry::make('noarsip')->label('No. Arsip'),
                        TextEntry::make('nama_arsip')->label('Nama Arsip'),
                        TextEntry::make('tanggal_arsip')->label('Tanggal Arsip'),
                        TextEntry::make('user.name')->label('User Pencipta')->badge(),
                        TextEntry::make('pencipta.nama_pencipta')->label('Pencipta Arsip'),
                        TextEntry::make('pengolah.nama_pengolah')->label('Pengolah Arsip'),
                        TextEntry::make('kode.nama')->label('Klasifikasi Arsip'),
                        TextEntry::make('lokasi.nama_lokasi')->label('Lokasi Arsip'),
                        TextEntry::make('media.nama_media')->label('Media Arsip'),
                        TextEntry::make('ket')->label('Keterangan Arsip'),
                        TextEntry::make('jumlah_arsip')->label('Jumlah Arsip'),
                        TextEntry::make('no_box')->label('No. Box'),
                        TextEntry::make('uraian')->label('Uraian Arsip'),
                        TextEntry::make('created_at')->label('Tanggal dibuat'),
                    ])->columns(2),


                ]),
                PdfViewerEntry::make('file_arsip')
                    ->label('View the PDF')
                    ->minHeight('70svh')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_arsip')
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
                    )->modalSubmitAction(false)->modalWidth(MaxWidth::ExtraLarge)->modalCancelAction(false)->extraModalFooterActions(fn (Action $action): array => [
                        $action->url(fn (Dataarsip $record): string => url($record->file_arsip))->openUrlInNewTab()->label('Buka Url'),
                    ]))
                ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalWidth(MaxWidth::Full),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('hapus')->modalDescription('Yakin mau menghapus ini?')->after(function (Dataarsip $record) {
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
}
