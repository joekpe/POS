<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receiving;
use App\Models\Product;
use App\Models\StockAudit;


class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        //dd($this->record);
        $receiving = new Receiving;
        $receiving->supplier_id = $this->record->supplier_id ? $this->record->supplier_id : 0;
        $receiving->product_id = $this->record->id;
        $receiving->quantity = $this->record->receiving_quantity;
        $receiving->cost = $this->record->wholesale_price;
        $receiving->save();

        $stockAudit = new StockAudit;
        $stockAudit->product_id = $this->record->id;
        $stockAudit->action = 'addition';
        $stockAudit->quantity = $this->record->receiving_quantity;
        $stockAudit->comment = 'Items added to stock via product creation';
        $stockAudit->user_id = auth()->user()->id;
        $stockAudit->save();
    }
}
