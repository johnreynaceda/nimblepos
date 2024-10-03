<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchInventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventoryStock(){
        return $this->belongsTo(InventoryStock::class);
    }
}
