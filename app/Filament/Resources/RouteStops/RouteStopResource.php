<?php

namespace App\Filament\Resources\RouteStops;

use App\Filament\Resources\RouteStops\Pages\CreateRouteStop;
use App\Filament\Resources\RouteStops\Pages\EditRouteStop;
use App\Filament\Resources\RouteStops\Pages\ListRouteStops;
use App\Filament\Resources\RouteStops\Pages\ViewRouteStop;
use App\Filament\Resources\RouteStops\Schemas\RouteStopForm;
use App\Filament\Resources\RouteStops\Schemas\RouteStopInfolist;
use App\Filament\Resources\RouteStops\Tables\RouteStopsTable;
use App\Models\RouteStop;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RouteStopResource extends Resource
{
    protected static ?string $model = RouteStop::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RouteStopForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RouteStopInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RouteStopsTable::configure($table);
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
            'index' => ListRouteStops::route('/'),
            'create' => CreateRouteStop::route('/create'),
            'view' => ViewRouteStop::route('/{record}'),
            'edit' => EditRouteStop::route('/{record}/edit'),
        ];
    }
}
