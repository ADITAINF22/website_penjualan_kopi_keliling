<?php

namespace App\Filament\Resources\RouteStops\Pages;

use App\Filament\Resources\RouteStops\RouteStopResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRouteStops extends ListRecords
{
    protected static string $resource = RouteStopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
