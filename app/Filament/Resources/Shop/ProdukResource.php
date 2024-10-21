<?php

namespace App\Filament\Resources\Shop;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Shop\Produk;
use Illuminate\Http\Request;
use App\Models\Shop\Kategori;
use App\Models\Shop\SubKategori;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\ProdukController;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Exports\Shop\ProdukExporter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Shop\ProdukResource\Pages;
use App\Filament\Resources\Shop\ProdukResource\RelationManagers;
use Marvinosswald\FilamentInputSelectAffix\TextInputSelectAffix;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Textinput::make('sku')
                                    ->required()
                                    ->label('SKU')
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('nama_produk')
                                    ->required(),
                                Forms\Components\MarkdownEditor::make('deskripsi')
                                    ->required()
                                    ->columnSpan('full'),


                            ])->columns(2),


                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('kategori_id')
                                    ->label('Kategori Produk')
                                    ->required()
                                    ->options(Kategori::all()->pluck('kategori', 'id'))
                                    ->live()
                                    ->searchable(),
                                Forms\Components\Select::make('sub_kategori_id')
                                    ->label('Sub Kategori Produk')
                                    ->searchable()
                                    ->required()
                                    ->options(fn($get) => SubKategori::where('kategori_id', $get('kategori_id'))->pluck('sub_kategori', 'id')),

                                TextInputSelectAffix::make('berat_barang')
                                    ->numeric()
                                    ->extraAttributes([
                                        'class' => 'w-[10px]' // if you want to constrain the selects size, depending on your usecase
                                    ])
                                    ->select(
                                        fn() => Forms\Components\Select::make('satuan')
                                            ->options([
                                                'kg' => 'kg',
                                                'gr' => 'gr',
                                            ]),
                                    )
                                    ->columnSpan('full'),

                                Forms\Components\TextInput::make('harga')
                                    ->label('Harga Produk')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->inputMode('numeric'),
                                Forms\Components\TextInput::make('stok')
                                    ->label('Stok Produk')
                                    ->required()
                                    ->numeric(),
                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Publish Produk')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Status Publish Produk'),
                            ]),
                        Forms\Components\Section::make('Upload Foto Produk')
                            ->description('Foto produk yang pertama kali diupload akan menjadi gambar utama pada list produk!')
                            ->schema([
                                Forms\Components\FileUpload::make('foto')

                                    ->label('Upload Foto')
                                    ->multiple()
                                    ->required(),

                            ]),



                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->stacked()
                    ->circular()
                    ->ring(3),
                Tables\Columns\TextColumn::make('nama_produk')
                    ->searchable()
                    ->sortable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Kategori.kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SubKategori.sub_kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(25),
                Tables\Columns\TextInputColumn::make('stok')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->afterStateUpdated(function ($record, $state) {
                        app()->make(ProdukController::class)->NotifikasiProdukEdit($record);
                    }),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->relationship('Kategori', 'kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->preload()
                    ->attribute('Kategori.kategori')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ProdukExporter::class)
                    ->label('Export Excel')
                    ->color('success')
                    ->icon('heroicon-o-archive-box-arrow-down'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('Ubah_Status_NonAktif')
                        ->action(function (Collection $records) {
                            $records->each->update(['status' => false]);
                        })
                        ->label('Non-Aktifkan Produk')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->after(function (Collection $records) {
                            $records->each(function ($record) {
                                Notification::make()
                                    ->title('Produk Berhasil di Non-Aktifkan!')
                                    ->warning()
                                    ->send();
                            });
                        }),

                    Tables\Actions\BulkAction::make('Ubah_Status_Aktif')
                        ->action(function (Collection $records) {
                            $records->each->update(['status' => true]);
                        })
                        ->label('Aktifkan Produk')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->after(function (Collection $records) {
                            $records->each(function ($record) {
                                Notification::make()
                                    ->title('Produk Berhasil di Aktifkan!')
                                    ->success()
                                    ->send();
                            });
                        }),
                ])->label('Ubah Data Secara Masal')
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
