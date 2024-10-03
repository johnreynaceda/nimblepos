<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;

class Report extends Component
{
    public $date_from, $date_to;
    public function render()
    {
        return view('livewire.admin.report',[
            'reports' => $this->generateReport(),
        ]);
    }

    public function generateReport(){
        return Transaction::when($this->date_from && $this->date_to, function($record){
            $record->whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to);
        })->get();
    }
}
