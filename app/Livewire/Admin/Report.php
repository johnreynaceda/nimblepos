<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Report extends Component
{
    public $date_from, $date_to;

    public $type;

    public function updatedType(){
        $this->reset('date_from', 'date_to');
    }

    public function updatedDateFrom(){
        $this->reset('type');
    }
    public function updatedDateTo(){
        $this->reset('type');
    }


    public function render()
    {
        return view('livewire.admin.report',[
            'reports' => $this->generateReport(),
        ]);
    }

    public function generateReport(){
        if ($this->type) {
            if ($this->type == 1) {
                // Today's transactions
                return Transaction::whereDate('created_at', Carbon::today())->get();
            } elseif ($this->type == 2) {
                // Last 7 days transactions
                return Transaction::whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])->get();
            } else {
                // This month's transactions
                return Transaction::whereMonth('created_at', Carbon::now()->month)
                                  ->whereYear('created_at', Carbon::now()->year)
                                  ->get();
            }
        }else{
            return Transaction::when($this->date_from && $this->date_to, function($record){
                $record->whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to);
            })->get();
        }
    }
}
