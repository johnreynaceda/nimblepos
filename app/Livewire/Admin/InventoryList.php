<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\InventoryStock;
use App\Models\Shop\Product;
use App\Models\StockCategory;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
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

class InventoryList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $stock_categories = [];
    public function table(Table $table): Table
    {
        return $table
            ->query(InventoryStock::query())->headerActions([
                CreateAction::make('new')->label('New Inventory')->icon('heroicon-o-plus')->action(
                    function($data){
                        $query = InventoryStock::count();
                        InventoryStock::create([
                            'stock_code' => $this->generateCode('IS-', $query+1),
                            'name' => $data['name'],
                           'stock_category_id' => $data['stock_category_id'],
                            'unit' => $data['unit'],
                            'volume' => $data['volume'],
                        //    'stock_quantity' => $data['stock_quantity'],
                            'cost' => $data['cost'],
                            // 'avg_cost' => $data['avg_cost'],
                            'low_stock' => $data['low_stock'],
                        ]);
                    }
                )->form([
                    Grid::make(3)->schema([
                        TextInput::make('stock_code')->disabled(),
                        TextInput::make('name')->required(),
                        Select::make('stock_category_id')->label('Stock Category')->required()->options(StockCategory::all()->pluck('name', 'id'))->searchable(),
                        Select::make('unit')->options([
                            'PCS' => 'PCS',
                            'G' => 'G',
                            'KG' => 'KG',
                        ]),
                        
                        TextInput::make('volume')->label('Volume')->numeric()->required(),
                        TextInput::make('cost')->numeric()->required(),
                        // TextInput::make('avg_cost')->label('Avg Cost')->numeric()->required(),
                        TextInput::make('low_stock')->label('Low Stock')->numeric()->required(),

                    ])
                ])->modalWidth('3xl')->modalHeading('Create Inventory')->createAnother(false),
                Action::make('s')->label('')->icon('heroicon-o-rectangle-stack')->action(
                    function($data){
                       sleep(1);
                      if (auth()->user()->user_type == 'admin') {
                        return redirect()->route('admin.stock-categories');
                      }else{
                        return redirect()->route('manager.stock-categories');
                      }
                    }
                )
            ])
            ->columns([
                TextColumn::make('stock_code')->searchable()->label('STOCK CODE'),
                TextColumn::make('name')->searchable()->label('NAME'),
                TextColumn::make('stockCategory.name')->searchable()->label('STOCK CATEGORY'),
                TextColumn::make('unit')->searchable()->label('UNIT'),
                TextColumn::make('volume')->searchable()->label('VOLUME'),
                TextColumn::make('cost')->searchable()->label('COST'),
                TextColumn::make('low_stock')->searchable()->label('LOW STOCK'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    Grid::make(3)->schema([
                        TextInput::make('stock_code')->disabled(),
                        TextInput::make('name')->required(),
                        Select::make('stock_category_id')->label('Stock Category')->required()->options(StockCategory::all()->pluck('name', 'id'))->searchable(),
                        Select::make('unit')->options([
                            'PCS' => 'PCS',
                            'G' => 'G',
                            'KG' => 'KG',
                        ]),
                        TextInput::make('volume')->required()->label('Volume')->numeric(),
                        // TextInput::make('stock_quantity')->label('Stock Qty')->numeric()->required(),
                        TextInput::make('cost')->numeric()->required(),
                        // TextInput::make('avg_cost')->label('Avg Cost')->numeric()->required(),
                        TextInput::make('low_stock')->label('Low Stock')->numeric()->required(),

                    ])
                    
                ])->modalWidth('xl')->modalHeading('Edit Category'),
                // DeleteAction::make('delete')
                Action::make('add_batch')->label('Add Batch')->button()->color('success')->icon('heroicon-o-document-plus')->url(fn (InventoryStock $record): string => route(auth()->user()->user_type == 'admin' ? 'admin.batch' : 'manager.batch', $record))
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Inventory Stocks yet!')->emptyStateDescription('Once you write your first inventory stocks, it will appear here.');
    }

    function generateCode($prefix, $number) {
        // Ensure the number is zero-padded to 4 digits
        $formattedNumber = str_pad($number, 4, '0', STR_PAD_LEFT);

        // Concatenate the prefix and the formatted number
        return $prefix . $formattedNumber;
    }

    public function render()
    {
        $this->stock_categories = StockCategory::all();
        return view('livewire.admin.inventory-list');
    }
}
