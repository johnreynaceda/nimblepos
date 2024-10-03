<?php

namespace App\Livewire\Admin;

use App\Models\BatchInventory;
use App\Models\Category;
use App\Models\InventoryStock;
use App\Models\Product;
use App\Models\ProductIngredient;
use App\Models\Transaction;
use App\Models\TransactionOrder;
use Livewire\Component;
use Flasher\SweetAlert\Prime\SweetAlertInterface;

class PointOfSale extends Component
{
    public $selected_category;
    public $product_items = [];
    public $subtotal = 0;
    public $discount = 0;
    public $vat = 0;
    public $total = 0;

    public $cash;
    public $discountToogle;
    public $change = 0;

    public $change_modal = false;

    public $receipt = false;

    public $transaction_number;

    public $transaction_type;

    public $customer;

    public function mount()
    {
        $trans = Transaction::whereDate('created_at', now())->count();
        
        $this->transaction_number = $this->generateCode('TR'.now()->format('md'), $trans + 1);
        // dd($this->transaction_number);
    }

    public function updatedDiscountToogle(){
       if ($this->product_items) {
        if ($this->discountToogle) {
            $this->discount = ($this->subtotal * 20) / 100;
        }else{
            $this->discount = 0;
        }
       }else{
        $this->discountToogle = false;
       }
    }

    public function updatedCash(){

        $this->change = (float)$this->cash - (float)$this->total;
       

    }

    public function proceed(){
        $this->validate([
            'transaction_type' => 'required',
        ]);
        if ($this->cash < $this->total) {
            sweetalert()->error('Your Cash must be greater than or equal to the total amount');
        }else{
            $this->change_modal = false;
            sleep(2);  // Simulate a delay (optional)
    
               if ($this->product_items ) {
                 // Check stock availability first before proceeding with any transaction
                 foreach ($this->product_items as $key => $value) {
                    $product = $value['id'];
                    $product_quantity = $value['quantity']; // Get the product quantity ordered
    
                    // Retrieve stock IDs related to the product
                    $stocks = ProductIngredient::where('product_id', $product)->pluck('inventory_stock_id')->toArray();
    
                    // Check each stock for this product
                    foreach (InventoryStock::whereIn('id', $stocks)->get() as $item) {
                        $cost = $item->volume * $product_quantity;  // Adjust the cost by multiplying it with the ordered quantity
    
                        // Get all active batches for this item with valid expiration dates
                        $batches = BatchInventory::where('inventory_stock_id', $item->id)
                            ->where('is_active', true)
                            ->where('expiration_date', '>=', now())
                            ->get();
    
                        // Calculate the total available stock across all batches
                        $total_available_stock = $batches->sum('stock_quantity');
    
                        // If the total available stock is less than the required cost, stop the process and show error
                        if ($total_available_stock < $cost) {
                            sweetalert()->error('Insufficient stock for inventory item ' . $item->name);
                            return;  // Stop the entire process if there's not enough stock
                        }
                    }
                }
    
                // If all stock validations pass, proceed with creating the transaction
                $transaction = Transaction::create([
                    'transaction_number' => $this->transaction_number,
                    'total_amount' => $this->total,
                    'discount' => $this->discount,
                    'status' => 'done',
                    'cash' => $this->cash,
                    'change' => $this->change,
                    'customer_name' => $this->customer ?? '.', // Replace with your customer ID
                    'transaction_type' => $this->transaction_type, // Replace with your transaction type (e.g., 'sale', 'purchase')
    
                    // 'user_id' => auth()->id(), // Replace with your user ID
                ]);
    
                // Now that stock is valid, deduct stock and create transaction orders
                foreach ($this->product_items as $key => $value) {
                    $product = $value['id'];
                    $product_quantity = $value['quantity']; // Get the product quantity ordered
    
                    // Retrieve stock IDs related to the product
                    $stocks = ProductIngredient::where('product_id', $product)->pluck('inventory_stock_id')->toArray();
    
                    // Update each stock quantity based on the product items
                    foreach (InventoryStock::whereIn('id', $stocks)->get() as $item) {
                        $cost = $item->volume * $product_quantity;  // Adjust the cost by multiplying it with the ordered quantity
                        $low_stock = $item->low_stock;  // Low stock threshold
    
                        // Get all active batches for this item with valid expiration dates
                        $batches = BatchInventory::where('inventory_stock_id', $item->id)
                            ->where('is_active', true)
                            ->where('expiration_date', '>=', now())
                            ->get();
    
                        $remaining_cost = $cost;  // Set remaining cost to total cost initially
    
                        // Loop through batches until the remaining cost is deducted
                        foreach ($batches as $batch) {
                            if ($batch->stock_quantity >= $remaining_cost) {
                                $batch->update([
                                    'stock_quantity' => $batch->stock_quantity - $remaining_cost,
                                ]);
                                $remaining_cost = 0;  // Cost is fully covered, exit loop
                                break;
                            } else {
                                // If the batch stock is less than the remaining cost, deplete it and go to the next batch
                                $remaining_cost -= $batch->stock_quantity;
                                $batch->update([
                                    'is_active' => false,  // Mark batch as inactive
                                    'stock_quantity' => 0,  // Deplete this batch
                                ]);
                            }
    
                            // Optional: Handle low stock notification if necessary
                            if ($batch->stock_quantity <= $low_stock) {
                                // Example: Notification::sendLowStockAlert($item);
                            }
                        }
    
                        // If there is still remaining cost after all batches, log an error or handle out-of-stock
                        if ($remaining_cost > 0) {
                            sweetalert()->error('Out of stock quantity for item ' . $item->name);
                            // $this->dispatchBrowserEvent('print-receipt');
                            return;  // Stop the process if stock runs out mid-way
                        }
                    }
    
                    // Create a transaction order after stock is successfully deducted
                    TransactionOrder::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $value['id'],
                        'quantity' => $value['quantity'],
                        // Assuming 'price' is available in $value, otherwise adjust accordingly
                        // 'total_price' => $value['price'] * $value['quantity'], // Optional, add total price if necessary
                    ]);
                }
                sweetalert()->success('Transaction order was successfully created.');
                $this->receipt = true;
               }else{
                sweetalert()->error("Cant process order, please add some product.");
               }
        }

       

    }

    public function calculateTotals()
    {
        $this->subtotal = (float) collect($this->product_items)->sum(fn($item) => (float) $item['price'] * (float) $item['quantity']);
        $this->vat = (float) $this->subtotal * 0.12; // Example VAT at 12%

        // Assuming $this->discount is also a double; otherwise, cast it as well.
        $this->discount = (float) $this->discount;

        // Calculate the total
        $this->total = (float) $this->subtotal - (float) $this->discount;
    }

    function generateCode($prefix, $number) {
        // Ensure the number is zero-padded to 4 digits
        $formattedNumber = str_pad($number, 4, '0', STR_PAD_LEFT);

        // Concatenate the prefix and the formatted number
        return $prefix . $formattedNumber;
    }

    public function calculateDiscount()
    {
        // Example: simple discount logic, replace with your own
        return $this->subtotal > 50 ? 5 : 0;
    }


    public function getProduct($product){
        $query = Product::where('id', $product)->first();
        $productExists = false;

        // if (count($this->product_items) > 0) {
        //    foreach ($this->product_items as $key => $value) {
        //      if ($value['id'] == $query->id) {
        //          $this->product_items[$key]['quantity']++;
        //          return;
        //      } else{
        //         $this->product_items[] = [
        //             'id' => $query->id,
        //             'name' => $query->name,
        //             'quantity' => 1,
        //             'price' => $query->price,
        //             'image' => $query->image_path,
        //         ];
        //      }

        //    }
        // }else{
        //     $this->product_items[] = [
        //         'id' => $query->id,
        //         'name' => $query->name,
        //         'quantity' => 1,
        //         'price' => $query->price,
        //         'image' => $query->image_path,
        //     ];
        // }

        if (count($this->product_items) > 0) {
            foreach ($this->product_items as $key => $value) {
                if ($value['id'] == $query->id) {
                    // If the product exists, increment the quantity
                    $this->product_items[$key]['quantity']++;
                    $productExists = true;
                    break; // Exit the loop since the product is found
                }
            }
        }

        // If the product doesn't exist, add it to the array
        if (!$productExists) {
            $this->product_items[] = [
                'id' => $query->id,
                'name' => $query->name,
                'quantity' => 1,
                'price' => $query->price,
                'image' => $query->image_path,
            ];
        }

    }

    public function removeProduct($key){
        unset($this->product_items[$key]);
    }

    
    public function confirmOrder() {
         if ($this->product_items) {
            sleep(2);
            $this->change_modal = true; 
         }

    }

    
        

    

    public function render()
    {
        $this->calculateTotals();
        return view('livewire.admin.point-of-sale',[
            'categories' => Category::where('is_visible', true)->get(),
            'products' => Product::when($this->selected_category, function(){
                return Product::where('category_id', $this->selected_category);
            })->where('is_active', true)->get(),
        ]);
    }
}
