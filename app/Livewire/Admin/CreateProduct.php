<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\InventoryStock;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductIngredient;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component implements HasForms
{
    use WithFileUploads;
    use InteractsWithForms;

    public $image = [];
    public $product_code, $sku, $name, $category, $description, $cost, $price, $profit, $status, $inventories, $unit;


    public function mount(){
        $this->sku = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    FileUpload::make('image')->required(),
                ]),
                Grid::make(3)->schema([
                    TextInput::make('product_code')->disabled(),
                    TextInput::make('sku')->label('SKU')->disabled(),
                    TextInput::make('name')->required(),
                    Select::make('category')->options(Category::all()->pluck('name', 'id'))->required(),
                    Textarea::make('description')->required()->columnSpan(2),
                    Select::make('inventories')->label('Raw Ingredients')->options(InventoryStock::all()->pluck('name', 'id'))->searchable()->multiple()->columnSpan(2)
                ]),
                Grid::make(3)->schema([
                    TextInput::make('cost')->numeric()->required()->prefix('₱')->live(),
                    TextInput::make('price')->numeric()->required()->prefix('₱')->live(),
                    TextInput::make('profit')->numeric()->required()->prefix('₱'),
                    Toggle::make('status')->label('Status')->onColor('success')
                ]),
            ]);
    }

    public function submitRecord(){

        $this->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'profit' => 'required|numeric',
            'inventories' => 'required|array',
            'image' => 'required|array',
        ]);

        foreach ($this->image as $key => $value) {
            $cat = Category::where('id', $this->category)->first()->name;

           $prod = Product::create([
                'product_code' => $this->generateCode(substr($cat, 0, 3), Product::count()+ 1),
                'name' => $this->name,
                'sku' => $this->sku,
                'category_id' => $this->category,
                'description' => $this->description,
                'cost' => $this->cost,
                'price' => $this->price,
                'profit' => $this->profit,
                'is_active' => $this->status ? $this->status : false,
                'image_path' => $value->store('Products', 'public'),
            ]);

            foreach ($this->inventories as $key => $item) {
                ProductIngredient::create([
                    'product_id' => $prod->id,
                    'inventory_stock_id' => $item,
                ]);
            }
        }


        sleep(1);
        return redirect()->route('admin.products');
    }

    function generateCode($prefix, $number) {
        // Ensure the number is zero-padded to 4 digits
        $formattedNumber = str_pad($number, 4, '0', STR_PAD_LEFT);

        // Concatenate the prefix and the formatted number
        return $prefix . $formattedNumber;
    }

    public function render()
    {
        $this->profit = (float) $this->price - (float)$this->cost;
        return view('livewire.admin.create-product');
    }
}
