<?php
namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class InvoicesImport implements ToModel, WithChunkReading
{
    use RemembersChunkOffset;

    public function model(array $row)
    {
        $chunkOffset = $this->getChunkOffset();
        if($chunkOffset > 1){
            //if(Invoice::where('InvoiceNo', $row[0])->count() == 0){
                return new Invoice([
                    "InvoiceNo"=>$row[0],
                    "StockCode"=>$row[1],
                    "Description"=>$row[2],
                    "Quantity"=>$row[3],
                    "InvoiceDate"=>\Carbon\Carbon::parse($row[4]),
                    "UnitPrice"=>$row[5],
                    "CustomerID"=>$row[6],
                    "Country"=>$row[7],
                ]);
            //}
        }
    }

    public function chunkSize(): int
    {
        return 200;
    }
}
