<?php

namespace App\Filament\Resources\Shop;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Shop\Kategori;
use App\Models\Shop\SubKategori;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Shop\SubKategoriResource\Pages;
use App\Filament\Resources\Shop\SubKategoriResource\RelationManagers;

class SubKategoriResource extends Resource
{
    protected static ?string $model = SubKategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationGroup = 'Pengaturan Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('kategori_id')
                            ->required()
                            ->searchable()
                            ->label('Kategori')
                            ->options(Kategori::all()->pluck('kategori', 'id')),
                        Forms\Components\TextInput::make('sub_kategori')
                            ->required(),
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('#')
                ->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('Kategori.kategori')
                    ->searchable()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('sub_kategori')
                    ->searchable()
                    ->label('Sub Kategori'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubKategoris::route('/'),
        ];
    }
}
