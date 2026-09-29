<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use App\Models\Product;


class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('channel')
                    ->label('Sumber pesanan')
                    ->options(['offline' => 'Langsung di tempat', 'online' => 'Website / WhatsApp'])
                    ->default('offline')
                    ->required(),
                TextInput::make('customer_name')->label('Nama pembeli')->default('Pembeli langsung')->required(),
                TextInput::make('phone')->label('No. HP')->nullable(),
                TextInput::make('address')->label('Lokasi')->nullable(),
                Textarea::make('note')->label('Catatan')->columnSpanFull(),
                Select::make('status')
                    ->options(['baru' => 'Baru', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'batal' => 'Batal'])
                    ->default('selesai')
                    ->required(),

                Repeater::make('items')
                    ->relationship()
                    ->label('Pesanan')
                    ->schema([
                        Select::make('product_id')
                            ->label('Menu')
                            ->options(fn() => Product::pluck('name', 'id'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($product = Product::find($state)) {
                                    $set('product_name', $product->name);
                                    $set('price', $product->price);
                                }
                            })
                            ->required(),
                        Hidden::make('product_name'),
                        TextInput::make('price')->label('Harga satuan')->numeric()->prefix('Rp')->required(),
                        TextInput::make('quantity')->label('Jumlah')->numeric()->default(1)->minValue(1)->required(),
                    ])
                    ->columns(3)
                    ->defaultItems(1)
                    ->addActionLabel('+ Tambah menu')
                    ->columnSpanFull(),
            ]);
    }
}
