<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Customer;

class CustomersStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Customers', Customer::all()->count())
        ];
    }
}
