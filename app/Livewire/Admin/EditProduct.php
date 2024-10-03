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
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component implements HasForms
{
    use WithFileUploads;
    use InteractsWithForms;
    
    public $product_id;
    public $image = [];

    public $image_edit;
    public $product_code, $name, $category, $description, $cost, $price, $profit, $status, $inventories = [];

    public function mount($id = null)
    {
        $this->product_id = $id ?? request('id');
        $this->loadProduct();
    }

    protected function loadProduct()
    {
        if ($this->product_id) {
            $product = Product::findOrFail($this->product_id);
            $this->product_code = $product->product_code;
            $this->name = $product->name;
            $this->category = $product->category_id;
            $this->description = $product->description;
            $this->cost = $product->cost;
            $this->price = $product->price;
            $this->profit = $product->profit; // Automatically calculate profit
            
            $this->status = $product->is_active;
            $this->inventories = ProductIngredient::where('product_id', $this->product_id)->pluck('inventory_stock_id')->toArray();
            $this->image = $product->image_path;
        }
    }


   public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    ViewField::make('rating')
                    ->view('filament.forms.product')->columnSpan(1)
                ]),
                Grid::make(3)->schema([
                    TextInput::make('product_code')->disabled(),
                    TextInput::make('name')->required(),
                    Select::make('category')
                        ->label('Category')
                        ->options(Category::all()->pluck('name', 'id'))
                        ->required(),
                    Textarea::make('description')
                        ->label('Description')
                        ->required()
                        ->columnSpan(2),
                    Select::make('inventories')
                        ->label('Raw Ingredients')
                        ->options(InventoryStock::all()->pluck('name', 'id'))
                        ->searchable()
                        ->multiple()
                        ->columnSpan(2),
                ]),
                Grid::make(3)->schema([
                    TextInput::make('cost')->numeric()->required()->prefix('₱'),
                    TextInput::make('price')->numeric()->required()->prefix('₱'),
                    TextInput::make('profit')
                        ->numeric()
                        ->required()
                        ->prefix('₱'),
                    Toggle::make('status')->label('Status')->onColor('success'),
                ]),
            ]);
    }

    public function updateRecord(){
    //    dd($this->image_edit);
        $this->validate([
            // 'product_code' => ['required','string','max:255'],
            'name' => ['required','string','max:255'],
            'category' => ['required', 'integer'],
            'description' => ['required','string','max:255'],
            'inventories' => ['required', 'array'],
            // 'image_edit' => ['nullable', 'image','max:1024'],  // 1MB max file size
            'cost' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'profit' => ['required', 'numeric'],
           'status' => ['required', 'boolean'],
        ]);

        $product = Product::find($this->product_id);
        $product->update([
            'product_code' => $this->product_code,
            'name' => $this->name,
            'category_id' => $this->category,
            'description' => $this->description,
            'cost' => $this->cost,
            'price' => $this->price,
            'profit' => $this->profit,
            'is_active' => $this->status,
            'image_path' => $this->image_edit ? $this->image_edit->store('Products', 'public') : $this->image,
        ]);

        ProductIngredient::where('product_id', $this->product_id)->delete();

        foreach($this->inventories as $inventory_id){
            ProductIngredient::create([
                'product_id' => $this->product_id,
                'inventory_stock_id' => $inventory_id,
            ]);
        }

        return redirect()->route('admin.products');


    }


    public function render()
    {
      
        
        return view('livewire.admin.edit-product');
    }
}
