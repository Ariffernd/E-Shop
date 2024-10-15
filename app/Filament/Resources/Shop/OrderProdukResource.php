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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Riwayat Pesanan';
    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
