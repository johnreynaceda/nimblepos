<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stockCategory(){
        return $this->belongsTo(StockCategory::class);
    }

    public function batchInventories(){
        return $this->hasMany(BatchInventory::class);
    }
}
