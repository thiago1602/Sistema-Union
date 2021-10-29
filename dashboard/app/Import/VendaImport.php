<?php

namespace App\Import;

use App\Models\Venda;
use App\Tools\Sanitize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Venda([

            'produto'=>$row['produto'],
            'valor'=>$row['valor'],
            'data_cadastro'=>$row['data_cadastro'],
            'user_id'=>$row['user_id'],
        ]);
   }
}
