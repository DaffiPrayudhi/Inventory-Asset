<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetActual extends Model
{
    use HasFactory;
    
    protected $table = 'asset_actual';
    protected $primaryKey = 'id_asset_act';
    public $timestamps = false; 
    
    protected $fillable = [
       'asset_number', 'asset_desc', 'asset_group', 'departement','nama_user', 'lokasi', 'asset_condition', 'confirm_date', 'status'
    ];
}
