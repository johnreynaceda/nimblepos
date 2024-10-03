<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Shop\Product;
use App\Models\StockCategory;
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
use Livewire\Component;

class StockCategoryList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(StockCategory::query())->headerActions([
                CreateAction::make('new')->label('New Stock Category')->icon('heroicon-o-plus')->form([
                    TextInput::make('name')->required(),
                    // Toggle::make('is_visible')->label('Visible')
                ])->modalWidth('xl')->modalHeading('Create Stock Category')->createAnother(false)
            ])
            ->columns([
                TextColumn::make('name')->searchable()->label('NAME')->formatStateUsing(
                    fn($record) => strtoupper($record->name)
                ),
               
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required(),
                    
                ])->modalWidth('xl')->modalHeading('Edit Category'),
                // DeleteAction::make('delete')
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Stock category yet!')->emptyStateDescription('Once you write your first stock category, it will appear here.');
    }


    public function render()
    {
        return view('livewire.admin.stock-category-list');
    }
}
