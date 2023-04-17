<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceivingResource\Pages;
use App\Filament\Resources\ReceivingResource\RelationManagers;
use App\Models\Receiving;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReceivingResource extends Resource
{
    protected static ?string $model = Receiving::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('supplier_id')
                    ->required(),
                Forms\Components\TextInput::make('product_id')
                    ->required(),
                Forms\Components\TextInput::make('cost')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier_id'),
                Tables\Columns\TextColumn::make('product_id'),
                Tables\Columns\TextColumn::make('cost'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
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
            'index' => Pages\ListReceivings::route('/'),
            'create' => Pages\CreateReceiving::route('/create'),
            'view' => Pages\ViewReceiving::route('/{record}'),
            'edit' => Pages\EditReceiving::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
