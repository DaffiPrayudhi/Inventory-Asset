<?php

namespace App\Imports;

use App\Models\AssetActual;
use App\Models\ActualQty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SparepartsImport implements ToModel
{
    use Importable;

    protected $data = [];

    public function model(array $row)
    {
        $assetNumber = isset($row[4]) ? $row[4] : null;
        $assetDesc = isset($row[5]) ? $row[5] : null;
        $assetGroup = isset($row[23]) ? $row[23] : null;
        $departement = isset($row[32]) ? $row[32] : null;
        $namaUser = isset($row[40]) ? $row[40] : null;
        $lokasi = isset($row[41]) ? $row[41] : null;
        $assetCondition = isset($row[42]) ? $row[42] : null;
        $confirmDate = isset($row[43]) ? $this->transformDate($row[43]) : null;
        $status = isset($row[44]) ? $row[44] : null;

        AssetActual::create([
            'asset_number'     => $assetNumber,
            'asset_desc'       => $assetDesc,
            'asset_group'      => $assetGroup,
            'departement'      => $departement,
            'nama_user'        => $namaUser,
            'lokasi'           => $lokasi,
            'asset_condition'  => $assetCondition,
            'confirm_date'     => $confirmDate,
            'status'           => $status,
        ]);
        if ($assetDesc && $departement) {
            if (!isset($this->data[$assetDesc][$departement])) {
                $this->data[$assetDesc][$departement] = 0;
            }
            $this->data[$assetDesc][$departement]++;
        }
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            if (is_numeric($value)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            } else {
                return Carbon::parse($value)->format($format);
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function importFinished()
    {
        DB::table('actual_qty')->truncate();

        foreach ($this->data as $assetDesc => $departements) {
            foreach ($departements as $departement => $qty) {
                ActualQty::updateOrCreate(
                    ['asset_desc' => $assetDesc, 'departement' => $departement],
                    ['qty' => $qty]
                );
            }
        }
    }
}
