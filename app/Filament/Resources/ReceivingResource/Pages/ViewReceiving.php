<?php

namespace App\Filament\Resources\ReceivingResource\Pages;

use App\Filament\Resources\ReceivingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReceiving extends ViewRecord
{
    protected static string $resource = ReceivingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
