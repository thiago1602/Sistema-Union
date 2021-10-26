<?php

namespace App\Import;

use App\Models\Venda;
use App\Tools\Sanitize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendaImport
{
    protected $venda;
   // protected $sanatize;

    public function __construct(Venda $venda, Sanitize $sanatize)
    {
        $this->venda = $venda;
       // $this->sanatize = $sanatize;
    }

    public function allData(Request $request)
    {
        //insert vendas in the database
        $read = IOFactory::load($request->file);
        $data = $read->getActiveSheet()->toArray();
        $line=0;
        $created=0;
        $updated=0;
        foreach($data as $item){
            //condition to verify if has 3 collumns in the worksheet
            if(count($item)==3){
                //your condition here to first line
                if($line==0){
                    //
                }
                if($line>0){
                    //verify if the current venda exists
                    $valor = $this->sanatize->validValor($item[1]);
                    $venda = $this->venda->where('valor',$valor)->first();
                    //if exists venda
                    if(!empty($venda)){
                        $venda->update([
                            'produto'=> $item[0],
                            'valor'=> $item[1],
                            'data_cadastro'=> $item[2],
                        ]);
                        $updated++;
                    //if not exists
                    }else{
                        $this->venda->create([
                            'produto'=> $item[0],
                            'valor'=> $item[1],
                            'data_cadastro'=> $item [2],
                        ]);
                        $created++;
                    }
                }
                $line++;
            //not exists 3 columns in the worksheet
            }else{
                throw new Exception(trans('platform.venda.message.import'));
            }
        }
        //returns imported worksheet notification
        $notification = [
            'message'=> "worksheet_imported",
            'created'=> $created,
            'updated'=> $updated
        ];
        return $notification;
    }
}
