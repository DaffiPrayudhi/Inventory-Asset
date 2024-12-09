<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\BaanQty;
use App\Models\ActualQty;
use App\Models\AssetActual;
use App\Models\AssetBaan;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SparepartsImports;
use App\Imports\SparepartsImport;
use DB;

class SparepartController extends Controller
{
    public function index()
    {
        // form qty baan vs qty actual
        $assetBaan = BaanQty::sum('qty');
        $assetActual = ActualQty::sum('qty');
        // filter
        $assetDescOptions = AssetBaan::select('asset_desc')->distinct()->pluck('asset_desc');
        $assetGroupOptions = AssetBaan::select('asset_group')->distinct()->pluck('asset_group');
        $departementOptions = AssetBaan::select('departement')->distinct()->pluck('departement');
        $lokasiOptions = AssetBaan::select('lokasi')->distinct()->pluck('lokasi');
        $assetConditionOptions = AssetBaan::select('asset_condition')->distinct()->pluck('asset_condition');
    
        $conditions = ['Baik', 'Dijual', 'Rusak', 'Discontinue', 'Tidak ditemukan'];
    
        $data = [];
        foreach ($conditions as $condition) {
            $data[$condition] = [
                'baan' => AssetBaan::where('asset_condition', $condition)->count(),
                'actual' => AssetActual::where('asset_condition', $condition)->count(),
            ];
        }
    
        $departments = ['PPIC', 'Engineering SMT', 'GA & EHS', 'Finance & Accounting', 'RnD', 'Maintenance & IT', 'Purchasing'];
    
        $data1 = [];
        foreach ($departments as $department) {
            $data1[$department] = [
                'baan' => BaanQty::where('departement', $department)->sum('qty'),
                'actual' => ActualQty::where('departement', $department)->sum('qty'),
            ];
        }
        
    
        return view('dashboard', compact('assetBaan', 'assetActual', 'data', 'data1', 
        'assetDescOptions', 'assetGroupOptions', 'departementOptions', 'lokasiOptions', 'assetConditionOptions'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    
    
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        
        DB::table('asset_baan')->truncate();
        
        DB::table('baan_qty')->truncate();
        
        $import = new SparepartsImports;
        $import->import($request->file('file'));
        $import->importFinished();
        
        return redirect()->back()->with('success', 'Data Excel Berhasil diimport');
    }
    
    public function importact(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        
        DB::table('asset_actual')->truncate();
        
        DB::table('actual_qty')->truncate();
        
        $import = new SparepartsImport;
        $import->import($request->file('file'));
        $import->importFinished();
        
        return redirect()->back()->with('success', 'Data Excel Berhasil diimport');
    }

    public function getData()
    {
        $spareparts = Sparepart::select('nama_barang', 'kode_barang', 'address', 'total_qty', 'lifetime', 'leadtime', 'min_stock', 'stock_akhir_wrhs'); 
        
        return DataTables::of($spareparts)->make(true);
    }

    public function getSpareparts(Request $request)
    {
        $query = AssetBaan::select(
            'asset_baan.asset_desc',
            'asset_baan.asset_group',
            'asset_baan.departement',
            'asset_baan.nama_user',
            'asset_baan.lokasi',
            'asset_baan.asset_condition',
            'asset_baan.confirm_date',
            'baan_qty.qty as qty_baan',
            'actual_qty.qty as qty_actual'
        )
        ->distinct('asset_baan.asset_desc')
        ->leftJoin('asset_actual', 'asset_baan.asset_desc', '=', 'asset_actual.asset_desc')
        ->leftJoin('baan_qty', 'asset_baan.asset_desc', '=', 'baan_qty.asset_desc')
        ->leftJoin('actual_qty', 'asset_baan.asset_desc', '=', 'actual_qty.asset_desc');
    
        // Apply filters
        if ($request->asset_desc) {
            $query->where('asset_baan.asset_desc', $request->asset_desc);
        }
    
        if ($request->departement) {
            $query->where('asset_baan.departement', $request->departement);
        }
    
        if ($request->lokasi) {
            $query->where('asset_baan.lokasi', $request->lokasi);
        }
    
        if ($request->asset_condition) {
            $query->where('asset_baan.asset_condition', $request->asset_condition);
        }
    
        if ($request->start_date) {
            $query->whereDate('asset_baan.confirm_date', '>=', $request->start_date);
        }
    
        if ($request->end_date) {
            $query->whereDate('asset_baan.confirm_date', '<=', $request->end_date);
        }
    
        // Fetch all data
        $spareparts = $query->get();
    
        // Return the data as JSON
        return response()->json($spareparts);
    }
      
    
}
