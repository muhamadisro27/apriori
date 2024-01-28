<?php

namespace App\Imports;

use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataTransactionImport implements ToCollection, WithHeadingRow
{


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $row)
    {
        $response = [];

        foreach ($row as $item) {
            $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item['tanggal']))->translatedFormat('Y-m-d');

            try {
                //code...
                DB::beginTransaction();

                DataTransaction::firstOrCreate([
                    'transaction_code' => $item['kode_transaksi'],
                ], [
                    'date' => $date,
                ]);

                DetailTransaction::updateOrCreate([
                    'transaction_code' => $item['kode_transaksi'],
                    'item_code' => $item['kode_barang'],
                    'item_name' => Str::lower($item['nama_barang']),
                    'quantity' => $item['quantity']
                ]);

                DB::commit();

            } catch (\Throwable $th) {

                DB::rollBack();
                //throw $th;
                $response = [
                    'status' => 'error',
                    'message' => $th->getMessage()
                ];
            }
        }

        return $response;
    }
}
