<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Columns\ViewColumn;
use Livewire\Component;

class ProductList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())->headerActions([
                Action::make('new')->label('New Product')->icon('heroicon-o-plus')->action(
                    function(){
                        sleep(1);
                        return redirect()->route('admin.products.create');
                    }
                )
            ])
            ->columns([
                TextColumn::make('product_code')->searchable()->label('PRODUCT CODE')->formatStateUsing(
                    fn($record) => strtoupper($record->product_code),
                ),
                TextColumn::make('sku')->searchable()->label('SKU'),
                TextColumn::make('name')->searchable()->label('NAME')->formatStateUsing(
                    fn($record) => strtoupper($record->name),
                ),
                TextColumn::make('description')->searchable()->label('DESCRIPTION')->formatStateUsing(
                    fn($record) => strtoupper($record->description),
                ),
                ViewColumn::make('image')->label('IMAGE')->view('filament.tables.columns.product-image'),
                TextColumn::make('category.name')->searchable()->label('CATEGORY')->formatStateUsing(
                    fn($record) => strtoupper($record->category->name),
                ),
                TextColumn::make('price')->searchable()->label('PRICE')->formatStateUsing(
                    fn($record) => '₱'.number_format($record->price,2)
                ),
                TextColumn::make('cost')->searchable()->label('COST')->formatStateUsing(
                    fn($record) => '₱'.number_format($record->cost,2)
                )->toggleable(),
                TextColumn::make('profit')->searchable()->label('PROFIT')->formatStateUsing(
                    fn($record) => '₱'.number_format($record->profit,2)
                )->toggleable(),
                ToggleColumn::make('is_active')->label('STATUS')->onColor('success')->onIcon('heroicon-o-check'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('edit')->color('success')->icon('heroicon-o-pencil-square')->url(fn (Product $record): string => route('admin.products.edit', $record))
                // DeleteAction::make('delete')
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No product yet!')->emptyStateDescription('Once you write your first product, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.product-list');
    }
}
