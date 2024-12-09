<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetBaan extends Model
{
    use HasFactory;
    
    protected $table = 'asset_baan';
    protected $primaryKey = 'id_asset';
    public $timestamps = false; 
    
    protected $fillable = [
       'asset_number', 'asset_desc', 'asset_group', 'departement', 'lokasi','nama_user', 'asset_condition', 'confirm_date', 'status'
    ];
}
