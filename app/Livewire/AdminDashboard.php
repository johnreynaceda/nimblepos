<?php

namespace App\Livewire;

use App\Models\BatchInventory;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
   use WithPagination;
    public $netsales = [];
    public $lastYearSales = [];

    public $grossSales = [];
    public $lastYearGrossSales = [];

    public function mount()
    {
        // Initialize arrays for 12 months (zero-indexed)
        $this->netsales = array_fill(0, 12, 0);
        $this->lastYearSales = array_fill(0, 12, 0);
        $this->grossSales = array_fill(0, 12, 0);
        $this->lastYearGrossSales = array_fill(0, 12, 0);
    
        // Get net sales and gross sales for the current year, grouped by month
        $currentYearSales = Transaction::whereYear('created_at', Carbon::now()->year)
            ->with('transactionOrders') // Assuming 'products' is the relation name
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('n'); // Group by month (1-12)
            });
    
        foreach ($currentYearSales as $month => $transactions) {
            $netSalesAmount = 0;
            $grossSalesAmount = 0;
    
            foreach ($transactions as $transaction) {
                // Assuming each product has an 'amount' field for net sales calculation
                // $netSalesAmount += $transaction->->sum('amount');

                foreach ($transaction->transactionOrders as $key => $value) {
                    $netSalesAmount += $value->product->sum('price') * $value->quantity;
             
                }
                
                // Assuming each transaction has a 'total_amount' field for gross sales calculation
                $grossSalesAmount += $transaction->total_amount;
            }

    
            $this->netsales[$month - 1] = $netSalesAmount;
            $this->grossSales[$month - 1] = $grossSalesAmount;
        }
    
        // Get net sales and gross sales for the previous year, grouped by month
        $previousYearSales = Transaction::whereYear('created_at', Carbon::now()->subYear()->year)
            ->with('transactionOrders') // Assuming 'products' is the relation name
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('n'); // Group by month (1-12)
            });
    
        foreach ($previousYearSales as $month => $transactions) {
            $netSalesAmount = 0;
            $grossSalesAmount = 0;
    
            foreach ($transactions as $transaction) {
                // Net sales calculation
                // $netSalesAmount += $transaction->products->sum('amount');

                foreach ($transaction->transactionOrders as $key => $value) {
                    $netSalesAmount += $value->product->sum('price') * $value->quantity;
             
                }
                // Gross sales calculation
                $grossSalesAmount += $transaction->total_amount;
            }
    
            $this->lastYearSales[$month - 1] = $netSalesAmount;
            $this->lastYearGrossSales[$month - 1] = $grossSalesAmount;
        }
    }
   

    public function render()
    {
        return view('livewire.admin-dashboard',[
            'lows' => BatchInventory::whereHas('inventoryStock', function ($query) {
                $query->whereColumn('stock_quantity', '<=', 'low_stock');
            })->get(),
            'expires' => BatchInventory::whereDate('expiration_date', '<=', now())->get(),
        ]);
    }
}
