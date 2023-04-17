<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255)
                    ->datalist(\App\Models\Product::pluck('category')),
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('wholesale_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('retail_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity_stock')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('receiving_quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('reorder_level')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
                Forms\Components\FileUpload::make('avatar')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                //Tables\Columns\TextColumn::make('supplier_id'),
                Tables\Columns\TextColumn::make('wholesale_price'),
                Tables\Columns\TextColumn::make('retail_price'),
                Tables\Columns\TextColumn::make('quantity_stock'),
                //Tables\Columns\TextColumn::make('receiving_quantity'),
                //Tables\Columns\TextColumn::make('reorder_level'),
                //Tables\Columns\TextColumn::make('description'),
                Tables\Columns\ImageColumn::make('avatar')->circular(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
