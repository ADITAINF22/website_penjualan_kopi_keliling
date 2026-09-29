<?php

namespace App\Filament\Resources\RouteStops\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class RouteStopForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('place_name')->label('Nama tempat')->required(),
                TextInput::make('address')->label('Alamat'),
                Select::make('day')
                    ->label('Hari')
                    ->options([1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'])
                    ->required(),
                TimePicker::make('start_time')->label('Jam mulai')->seconds(false)->required(),
                TimePicker::make('end_time')->label('Jam selesai')->seconds(false)->required(),
                TextInput::make('latitude')->numeric(),
                TextInput::make('longitude')->numeric(),
            ]);
    }
}
