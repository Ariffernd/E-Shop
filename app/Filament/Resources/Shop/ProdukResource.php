<?php

namespace App\Filament\Resources\Shop;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Shop\Produk;
use App\Models\Shop\Kategori;
use App\Models\Shop\SubKategori;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
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
                                    ->required(),
                                Forms\Components\TextInput::make('stok')
                                    ->label('Stock Produk')
                                    ->required()
                                    ->numeric(),
                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Upload Foto Produk')
                            ->description('Foto produk yang pertama kali diupload akan menjadi gambar utama pada list produk!')
                            ->schema([
                                Forms\Components\FileUpload::make('foto')

                                    ->label('Upload Foto')
                                    ->multiple()
                                    ->required(),

                            ]),
                        Forms\Components\Section::make('Publish Produk')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Status Publish Produk'),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Kategori.kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SubKategori.sub_kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
