<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Product;
use Filament\Forms;
use Filament\Pages\Actions\Action;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    //protected static string $view = 'filament.pages.edit-product';

    protected function getActions(): array
    {
        return [
            Actions\Action::make('update_stock')
                ->action('openStockUpdateModal')
                ->form([
                    Forms\Components\Select::make('action')
                        ->label('Action')
                        ->options([
                            'addition' => 'Addition', 
                            'subtraction' => 'Subtraction'
                        ])
                        ->default('addition'),
                    Forms\Components\TextInput::make('quantity')
                        ->numeric()
                        ->minValue(1)
                ]),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

}
