<?php

namespace App\Filament\Resources\ReceivingResource\Pages;

use App\Filament\Resources\ReceivingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Product;
use App\Models\StockAudit;

class CreateReceiving extends CreateRecord
{
    protected static string $resource = ReceivingResource::class;

    public function afterCreate(): void
    {
        $product = Product::find($this->record->product_id);
        $product->quantity_stock = $this->record->quantity + $product->quantity_stock;

        $stockAudit = new StockAudit;
        $stockAudit->product_id = $product->id;
        $stockAudit->action = 'addition';
        $stockAudit->quantity = $this->record->quantity;
        $stockAudit->comment = str($this->record->quantity) .' Items added to stock via receiving creation to make a total of '. str($product->quantity_stock);
        $stockAudit->user_id = auth()->user()->id;

        $product->save();

        $stockAudit->save();
    }
}
