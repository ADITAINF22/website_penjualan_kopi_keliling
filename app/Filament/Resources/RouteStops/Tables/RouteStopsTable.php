<?php

namespace App\Filament\Resources\RouteStops\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class RouteStopsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('place_name')->label('Tempat')->searchable(),
                TextColumn::make('day')
                    ->label('Hari')
                    ->formatStateUsing(fn($state) => [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'][$state] ?? $state)
                    ->sortable(),
                TextColumn::make('start_time')->label('Mulai')->time('H:i'),
                TextColumn::make('end_time')->label('Selesai')->time('H:i'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
