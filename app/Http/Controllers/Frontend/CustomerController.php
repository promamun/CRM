<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers= Customer::orderBy('created_at','desc')->where('type',1)->get();
        return view('frontend.customer.index',compact('customers'));
    }
    public function customerEdit($id){
        return $data = Customer::with('cusTrans')->find($id);
    }
    public function customerStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $addCustomer = new Customer();
        $addCustomer->name  = $request->name;
        $addCustomer->company_name  = $request->company_name;
        $addCustomer->email  = $request->email;
        $addCustomer->phone  = $request->phone;
        $addCustomer->address  = $request->address;
        $addCustomer->type  = 1;
        $addCustomer->save();
        $debit=0; $credit=0;
        if (is_numeric($request->debit)){
            $debit=$request->debit;
        }
        if (is_numeric($request->credit)){
            $credit=$request->credit;
        }
        if ($debit > 0 || $credit > 0){
//            $addCustomer->id
            $dBTrans = new Transaction();
            $dBTrans->ledger_id = $addCustomer->id;
            $dBTrans->debit = $debit;
            $dBTrans->credit = $credit;
            $dBTrans->entry_date = date("Y-m-d");
            $dBTrans->type = 'OPENING BALANCE';
            $dBTrans->save();
        }
        return redirect()->back()->with('message','Customer Add success');
    }
    public function customerUpdate(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $updateCustomer = Customer::with('cusTrans')->find($request->id);
        $updateCustomer->name  = $request->name;
        $updateCustomer->company_name  = $request->company_name;
        $updateCustomer->email  = $request->email;
        $updateCustomer->phone  = $request->phone;
        $updateCustomer->address  = $request->address;
        $updateCustomer->save();
        $debit=0; $credit=0;
        if (is_numeric($request->debit)){
            $debit=$request->debit;
        }
        if (is_numeric($request->credit)){
            $credit=$request->credit;
        }
        if ($debit > 0 || $credit > 0){
            foreach ($updateCustomer->cusTrans as $uCus){
                $uCus->debit = $debit;
                $uCus->credit = $credit;
                $uCus->type = 'OPENING BALANCE';
                $uCus->save();
            }
        }
        return redirect()->back()->with('message','Customer Update success');
    }
    public function customerView($id){
        $customerDetail = Customer::find($id);
        $transDetails = Transaction::where('ledger_id',$id)->get();
        $debit = Transaction::where('ledger_id',$id)->sum('debit');
        $credit = Transaction::where('ledger_id',$id)->sum('credit');
        return view('frontend.customer.customerDetail',compact('customerDetail','transDetails','debit','credit'));
    }
    public function customerBankData($value){
        if ($value==='Customer'){
            $customerData =Customer::where('type',1)->orderBy('created_at','desc')->get();
            return response()->json($customerData);
        }elseif ($value==='Bank'){
            $bankData =Bank::orderBy('created_at','desc')->get();
            return response()->json($bankData);
        }else{
            $supplierData =Customer::where('type',0)->orderBy('created_at','desc')->get();
            return response()->json($supplierData);
        }
    }
}
