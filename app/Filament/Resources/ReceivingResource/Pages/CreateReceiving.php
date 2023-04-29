<?php

namespace App\Filament\Resources\ReceivingResource\Pages;

use App\Filament\Resources\ReceivingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Product;

class CreateReceiving extends CreateRecord
{
    protected static string $resource = ReceivingResource::class;

    public function afterCreate(): void
    {
        $product = Product::find($this->record->product_id);
        $product->quantity_stock = $this->record->quantity + $product->quantity_stock;
        $product->save();
    }
}
