<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualQty extends Model
{
    use HasFactory;

    protected $table = 'actual_qty';
    protected $primaryKey = 'id_sys';
    public $timestamps = false; 
    
    protected $fillable = [
       'asset_desc', 'departement', 'qty'
    ];
}
