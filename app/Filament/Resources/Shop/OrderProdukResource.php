<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\OrderProdukResource\Pages;
use App\Filament\Resources\Shop\OrderProdukResource\RelationManagers;
use App\Models\Shop\OrderProduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderProdukResource extends Resource
{
    protected static ?string $model = OrderProduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('produk_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('order_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('snap_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nomor_wa')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ongkir')
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_bayar')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('no_resi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_pemesanan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('metode_pembayaran')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_transaksi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('produk_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('snap_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_wa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ongkir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_bayar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_resi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pemesanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_transaksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListOrderProduks::route('/'),
            'create' => Pages\CreateOrderProduk::route('/create'),
            'edit' => Pages\EditOrderProduk::route('/{record}/edit'),
        ];
    }
}
