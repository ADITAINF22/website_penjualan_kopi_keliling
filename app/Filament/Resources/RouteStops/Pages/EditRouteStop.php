<?php

namespace App\Filament\Resources\RouteStops\Pages;

use App\Filament\Resources\RouteStops\RouteStopResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRouteStop extends EditRecord
{
    protected static string $resource = RouteStopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
