<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\InventoryStock;
use App\Models\Shop\Product;
use App\Models\StockCategory;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
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

class BatchInventory extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $batch_id;

    public function mount(){
        $this->batch_id = request('id');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\BatchInventory::query()->where('inventory_stock_id', $this->batch_id))->headerActions([
                CreateAction::make('new')->label('New Batch')->icon('heroicon-o-plus')->action(
                    function($data){
                        $query = \App\Models\BatchInventory::where('inventory_stock_id', $this->batch_id)->count();
                        \App\Models\BatchInventory::create([
                            'batch_code' => $this->generateCode(now()->format('dmy'). '-', $query+1),
                            'inventory_stock_id' => $this->batch_id,
                            'stock_quantity' => $data['stock_quantity'],
                            'expiration_date' => Carbon::parse($data['expiration_date']),
                            'is_active' => true
                        ]);
                    }
                )->form([
                    Grid::make(3)->schema([
                        TextInput::make('batch_code')->disabled(),
                        TextInput::make('stock_quantity')->required(),
                        DatePicker::make('expiration_date')->required(),
                    ])
                ])->modalWidth('3xl')->modalHeading('Create Batch Inventory'),
               
            ])
            ->columns([
                TextColumn::make('batch_code')->searchable()->label('BATCH CODE'),
                TextColumn::make('stock_quantity')->searchable()->label('STOCK QUANTITY'),
                TextColumn::make('expiration_date')->date()->searchable()->label('EXPIRATION DATE'),
                ToggleColumn::make('is_active')->onColor('success')->offColor('danger')->label('STATUS'),
               
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // EditAction::make('edit')->color('success')->form([
                //     Grid::make(3)->schema([
                       
                //     ])
                    
                // ])->modalWidth('xl')->modalHeading('Edit Category'),
                // DeleteAction::make('delete')
                // Action::make('add_batch')->label('Add Batch')->button()->color('success')->icon('heroicon-o-document-plus')->url(fn (InventoryStock $record): string => route('admin.batch', $record))
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Batch Inventory  yet!')->emptyStateDescription('Once you add batch inventory, it will appear here.');
    }

    function generateCode($prefix, $number) {
        // Ensure the number is zero-padded to 4 digits
        $formattedNumber = str_pad($number, 0, '0', STR_PAD_LEFT);

        // Concatenate the prefix and the formatted number
        return $prefix . $formattedNumber;
    }

    public function render()
    {
        return view('livewire.batch-inventory');
    }
}
