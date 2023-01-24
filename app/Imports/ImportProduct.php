<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportProduct implements ToCollection, WithStartRow
{
   
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Product::create([
            'name' => $row[0],
            'sku' => $row[1],
            'price' => $row[2],
            'description' => $row[3],
            'created_by' => auth()->id(),
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
