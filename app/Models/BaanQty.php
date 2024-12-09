<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaanQty extends Model
{
    use HasFactory;

    protected $table = 'baan_qty';
    protected $primaryKey = 'id_baan';
    public $timestamps = false; 
    
    protected $fillable = [
       'asset_desc', 'departement', 'qty'
    ];
}
