<?php

namespace App\Filament\Resources\SupplierResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Supplier;

class SuppliersStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Customers', Supplier::all()->count())
        ];
    }
}
