<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Arsippegawai;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as Sec;
use Filament\Infolists\Components\Tabs as InfoTab;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArsippegawaiResource\Pages;
use Filament\Infolists\Components\Group as ComponentsGroup;
use App\Filament\Resources\ArsippegawaiResource\RelationManagers;
use App\Filament\Resources\ArsippegawaiResource\Pages\ViewPegawai;
use App\Filament\Resources\ArsippegawaiResource\Pages\EditArsippegawai;
use App\Filament\Resources\ArsippegawaiResource\Pages\ListArsippegawais;
use App\Filament\Resources\ArsippegawaiResource\Pages\ArsiprelatedRecord;
use App\Filament\Resources\ArsippegawaiResource\RelationManagers\PegawaiRelationManager;
use App\Models\Dataarsip;

class ArsippegawaiResource extends Resource
{
    protected static ?string $model = ArsipPegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Arsip Pegawai';
    protected static ?string $slug = 'arsip-pegawai';
    protected static ?string $label = 'Pegawai';
    protected static ?string $pluralLabel = "Arsip Pegawai";

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Data Pribadi')->schema([

                        TextInput::make('nama_lengkap')->label('Nama Lengkap & Gelar')->rules('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Nama Lengkap Harus diisi!'
                        ]),
                        TextInput::make('tempat_lahir')->label('Tempat Lahir')->rules('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Tempat Lahir Harus diisi!'
                        ]),
                        DatePicker::make('tgl_lahir')->label('Tanggal Lahir')->native(false)->placeholder(Carbon::now()->toFormattedDateString())->required()->validationMessages([
                            'required' => 'Tanggal Lahir harus diisi.',
                        ]),
                        Select::make('jenis_kelamin')->label('Jenis Kelamin')
                            ->options([
                                'Laki-Laki' => 'Laki-Laki',
                                'Perempuan' => 'Perempuan',
                            ])->rules('required')->markAsRequired(true)->validationMessages([
                                'required' => 'Jenis Kelamin Harus diisi!'
                            ]),
                        Select::make('agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Budha' => 'Budha',
                                'Konghucu' => 'Konghucu',
                            ])->rules('required')->markAsRequired(true)->validationMessages([
                                'required' => 'Agama Harus diisi!'
                            ]),
                        Textarea::make('alamat')
                            ->autosize()->rules('required')->markAsRequired(true)->validationMessages([
                                'required' => 'Alamat Harus diisi!'
                            ]),
                        TextInput::make('no_hp')->tel()->validationMessages([
                            'regex' => 'Masukkan no hp yang valid'
                        ]),
                        TextInput::make('email')->email()->validationMessages([
                            'required' => 'Email harus diisi.',
                            'email' => 'Email Harus Valid'
                        ]),
                    ])->columns(2),


                    Section::make('Data Kepegawaian')->schema([
                        TextInput::make('nip')->unique(ignoreRecord: true)->label('NIP')->rules('required|numeric|digits:18')->markAsRequired(true)->validationMessages([
                            'required' => 'NIP Harus diisi!',
                            'unique' => 'NIP Sudah Terdaftar!',
                            'numeric' => 'Harus Berupa Angka!',
                            'digits' => 'NIP Berisi 18 Digit Angka!'
                        ]),
                        TextInput::make('nik')->label('NIK')->rules('numeric|digits:16')->markAsRequired(true)->validationMessages([
                            'numeric' => 'Harus Berupa Angka!',
                            'digits' => 'NIK Berisi 16 Digit Angka!'
                        ]),
                        TextInput::make('pangkat_gol'),
                        TextInput::make('jabatan'),
                        TextInput::make('satker')->label('Satuan Kerja')->rules('required')->markAsRequired(true)->validationMessages([
                            'required' => 'Satuan Kerja Harus diisi!',
                        ]),
                    ])->columns(2)


                ])->columns(2)->columnSpan(2),

                Group::make()->schema([
                    Section::make('Foto Profil')->schema([
                        FileUpload::make('foto_profile')
                            ->directory('foto_pegawai')
                            ->image()
                            ->label("")
                            ->avatar()
                            ->imageEditor()
                            ->circleCropper()
                            ->extraAttributes(['class' => 'flex justify-center items-center']),
                    ])->grow(false)->columnSpan('full'),

                    Section::make()->schema([
                        ToggleButtons::make('status_pegawai')
                            ->label('Status Pegawai')
                            ->options([
                                1 => 'Aktif',
                                0 => 'Tidak Aktif',

                            ])
                            ->colors([
                                0 => 'danger',
                                1 => 'success',
                            ])
                            ->icons([
                                0 => 'heroicon-o-x-circle',
                                1 => 'heroicon-o-check-circle'
                            ])
                            ->grouped()->default(1)
                    ])->grow(false)
                ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('nip')->searchable(),
                TextColumn::make('nama_lengkap')->searchable(),
                TextColumn::make('status_pegawai')->badge()
                    ->state(function ($record) {
                        if ($record->status_pegawai && $record->status_pegawai > 0) {
                            return "Aktif";
                        } else {
                            return "Tidak Aktif";
                        }
                    })
                    ->color(fn (string $state): string => match ($state) {
                        "Aktif" => 'success',
                        "Tidak Aktif" => 'danger',
                    })->icon(fn (string $state): string => match ($state) {
                        "Aktif" => 'heroicon-o-check-circle',
                        "Tidak Aktif" => 'heroicon-o-x-circle',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_pegawai')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->after(function (Arsippegawai $record) {

                    return  Dataarsip::where('arsip_pegawai_id', $record->uuid)->delete();
                }),
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
                ComponentsGroup::make()->schema([
                    InfoTab::make('Tabs')
                        ->tabs([
                            InfoTab\Tab::make('Data Pribadi')
                                ->icon('heroicon-m-user')
                                ->schema([

                                    ComponentsGroup::make()->schema([
                                        ComponentsGroup::make()->schema([
                                            TextEntry::make('nama_lengkap')->label('Nama Lengkap & Gelar'),
                                            TextEntry::make('')->label('Tempat, Tanggal Lahir')->state(function ($record) {
                                                return $record->tempat_lahir . ', ' . Carbon::parse($record->tgl_lahir)->locale('id')->format('d F Y');
                                            }),
                                            TextEntry::make('jenis_kelamin')->label('Jenis Kelamin'),
                                            TextEntry::make('alamat')->label('Alamat'),
                                            TextEntry::make('agama')->label('Agama'),
                                            TextEntry::make('no_hp')->label('No.HP'),
                                            TextEntry::make('email')->label('Email')->default('-'),
                                        ])->columns(2)->columnSpan(2),
                                        ImageEntry::make('foto_profile')->defaultImageUrl(function ($record) {
                                            return url('https://api.dicebear.com/9.x/bottts-neutral/svg?seed=' . $record->uuid);
                                        })->circular()

                                    ])->columns(3),

                                ]),
                            InfoTab\Tab::make('Data Kepegawaian')
                                ->icon('heroicon-m-identification')
                                ->schema([
                                    ComponentsGroup::make()->schema(
                                        [
                                            TextEntry::make('nip')->label('NIP'),
                                            TextEntry::make('nik')->label('NIK')->default('-'),
                                            TextEntry::make('pangkat_gol')->label('Pangkat Golongan')->default('-'),
                                            TextEntry::make('jabatan')->label('Jabatan')->default('-'),
                                            TextEntry::make('satker')->label('Satuan Kerja'),
                                            TextEntry::make('status_pegawai')
                                                ->badge()
                                                ->state(function ($record) {
                                                    if ($record->status_pegawai && $record->status_pegawai > 0) {
                                                        return "Aktif";
                                                    } else {
                                                        return "Tidak Aktif";
                                                    }
                                                })
                                                ->color(fn (string $state): string => match ($state) {
                                                    "Aktif" => 'success',
                                                    "Tidak Aktif" => 'danger',
                                                })->icon(fn (string $state): string => match ($state) {
                                                    "Aktif" => 'heroicon-o-check-circle',
                                                    "Tidak Aktif" => 'heroicon-o-x-circle',
                                                })
                                        ]
                                    )->columns(2)
                                ]),
                        ])->columnSpanFull()
                ])->columnSpanFull()
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewPegawai::class,
            ArsiprelatedRecord::class,
            EditArsippegawai::class,
        ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArsippegawais::route('/'),
            'create' => Pages\CreateArsippegawai::route('/create'),
            'edit' => Pages\EditArsippegawai::route('/{record}/edit'),
            'view' => Pages\ViewPegawai::route('/{record}'),
            'arsip' => ArsiprelatedRecord::route('/{record}/arsip'),
        ];
    }
}
