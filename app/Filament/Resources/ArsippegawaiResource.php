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
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as Sec;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArsippegawaiResource\Pages;
use App\Filament\Resources\ArsippegawaiResource\RelationManagers;
use App\Filament\Resources\ArsippegawaiResource\Pages\ViewPegawai;
use App\Filament\Resources\ArsippegawaiResource\Pages\EditArsippegawai;
use App\Filament\Resources\ArsippegawaiResource\Pages\ListArsippegawais;
use App\Filament\Resources\ArsippegawaiResource\Pages\ArsiprelatedRecord;
use App\Filament\Resources\ArsippegawaiResource\RelationManagers\PegawaiRelationManager;

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

                        TextInput::make('nama_lengkap')->label('Nama Lengkap'),
                        TextInput::make('tempat_lahir'),
                        DatePicker::make('tgl_lahir')->label('Tanggal Lahir')->native(false)->placeholder(Carbon::now()->toFormattedDateString())->required()->validationMessages([
                            'required' => 'Tanggal Arsip harus diisi.',
                        ]),
                        Select::make('status')
                            ->options([
                                'Laki-Laki' => 'Laki-Laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        Select::make('agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Budha' => 'Budha',
                                'Konghucu' => 'Konghucu',
                            ]),
                        Textarea::make('alamat')
                            ->autosize()
                    ])->columns(2),


                ])->columns(2)->columnSpan(2),

                Group::make()->schema([
                    Section::make('Foto Profil')->schema([
                        FileUpload::make('foto_profile')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->circleCropper(),
                    ])->columnSpan(2)
                ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
                Sec::make()->schema([
                    TextEntry::make('nama_lengkap'),
                    ImageEntry::make('image')->defaultImageUrl(url('https://api.dicebear.com/9.x/bottts-neutral/svg?seed=Nunaaaa'))->circular()
                ]),
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
