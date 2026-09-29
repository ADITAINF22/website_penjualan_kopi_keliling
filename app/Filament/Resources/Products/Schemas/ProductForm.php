<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nama menu')->required(),
                Textarea::make('description')->label('Deskripsi')->columnSpanFull(),
                TextInput::make('price')->label('Harga')->numeric()->prefix('Rp')->required(),
                FileUpload::make('image')->label('Foto')->image()->directory('products'),
                Toggle::make('is_available')->label('Tersedia')->default(true),
            ]);
    }
}
