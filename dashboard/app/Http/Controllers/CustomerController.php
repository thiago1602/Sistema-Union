<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ImportRequest;
use App\Import\CustomerImport;
use App\Models\Customer;
use App\Report\CustomerReport;
use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{


    public function index()
    {

        $user_id = auth()->user()->id;
        $customers = Customer::where('user_id', $user_id)->paginate(10);
        return view('customer.index',['customers' => $customers]);
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(CustomerRequest $request)
    {
        $dados = $request->all('name','email', 'cpf', 'data_cadastro');
        if (isset(auth()->user()->id)) {
            $dados['user_id'] = auth()->user()->id;
        }

        $customers = Customer::create($dados);
        return redirect()->route('customer.show', ['customers' => $customers->id]);
    }


    public function show(Customer $customers)
    {
        return view('customer.show', ['customers'=> $customers]);
    }

    public function edit(Customer $customers)
    {
        $user_id = auth()->user()->id;

        if($customers->user_id == $user_id){
            return view('customer.edit', ['customers' => $customers]);

        }

        return view('acesso-negado');

    }

    public function update(Request $request, Customer $customers)
    {

        if (!$customers->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }

        $customers->update($request->all());
        return redirect()->route('customer.show', ['customers' => $customers->id]);
    }



    public function destroy(Customer $customers)
    {

        if (!$customers->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
        $customers->delete();
        return redirect()->route('customer.index');

    }

//    public function import()
//    {
//        return view('customer.import');
//    }
//
//    public function storeImport(ImportRequest $request)
//    {
//        try{
//            $notification = $this->customer_import->allData($request);
//            $notification = array(
//                'title'=> trans('validation.generic.Success'),
//                'message'=> trans('validation.generic.imported')." ".
//                            trans('validation.generic.data_created')." : ".$notification['created'].". ".
//                            trans('validation.generic.data_updated')." : ".$notification['updated'],
//                'alert-type' => 'success'
//            );
//            /*
//            if($notification['message'] == "worksheet_imported"){
//                $notification = array(
//                    'title'=> trans('validation.generic.Success'),
//                    'message'=> trans('validation.generic.imported')." ".
//                                trans('validation.generic.data_created')." : ".$notification['created'].". ".
//                                trans('validation.generic.data_updated')." : ".$notification['updated'],
//                    'alert-type' => 'success'
//                );
//            }
//            */
//            /*
//            if($notification['message']  == "worksheet_invalid"){
//                $notification = array(
//                    'title'=> trans('validation.generic.Error'),
//                    'message'=> trans('platform.customer.message.import'),
//                    'alert-type' => 'danger'
//                );
//                return back()->withInput()->with($notification);
//            }
//            */
//            return redirect()->route('customers.index')->with($notification);
//
//        }
//        catch(\Exception $e)
//        {
//            $notification = array(
//                'title'=> trans('validation.generic.Error'),
//                'message'=> trans('validation.generic.not_imported').': '.$e->getMessage(),
//                'alert-type' => 'danger'
//            );
//            return back()->with($notification)->withInput();
//        }
//    }

    public function report($extensao)
    {


        $nome_arquivo =  'lista_de_clientes';

        if ($extensao == 'xlsx'){
            $nome_arquivo .= '.'.$extensao;
        }else if ($extensao == 'csv'){
            $nome_arquivo .= '.'.$extensao;
        } else{
            return redirect()->route('customer.index');

        }
        return Excel::download(new CustomersExport, $nome_arquivo);




       /** if($customer_id==null){
            $customers = $this->customer->all();
        }else{
            $customers = $this->customer->where('id',$customer_id)->get();
        }
        try{
            $notification = $this->customer_report->list($customers);
        }
        catch(\Exception $e){
            $notification = array(
                'title'=> trans('platform.generic.Error'),
                'message'=> trans('platform.report.message.generated_error').': '.$e->getMessage(),
                'alert-type' => 'danger'
            );
        }
        return back()->with($notification);
        **/
    }

}
