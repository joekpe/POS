<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Product;
use Filament\Forms;
use Filament\Pages\Actions\Action;
use Filament\Notifications\Notification; 

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    //protected static string $view = 'filament.pages.edit-product';

    protected function getActions(): array
    {
        return [
            Actions\Action::make('update_stock')
                ->action('stockUpdate')
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
                        ->required()
                ]),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    public function stockUpdate(){
        //dd($this->mountedActionData['action']);
        $product = Product::find($this->record->id);
        if($this->mountedActionData['action'] == "addition"){
            $product->quantity_stock = $product->quantity_stock + $this->mountedActionData['quantity'];
            $product->save();
            Notification::make() 
                    ->title('Saved')
                    ->success()
                    ->send(); 
        }else{
            if($this->mountedActionData['quantity'] > $product->quantity_stock){
                Notification::make() 
                    ->title('The quantity to subtract is larger than what is in stock')
                    ->danger()
                    ->send(); 
            }else{
                $product->quantity_stock = $product->quantity_stock - $this->mountedActionData['quantity'];
                $product->save();
                Notification::make() 
                        ->title('Saved')
                        ->success()
                        ->send(); 
            }
        }
        //dd($product);
    }

}
