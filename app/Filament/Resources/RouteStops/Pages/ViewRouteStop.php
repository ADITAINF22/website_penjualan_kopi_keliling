<?php

namespace App\Filament\Resources\RouteStops\Pages;

use App\Filament\Resources\RouteStops\RouteStopResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRouteStop extends ViewRecord
{
    protected static string $resource = RouteStopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
