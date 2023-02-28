<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankTransaaction;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(){
        $banks= Bank::with('bankTrans')->orderBy('created_at','desc')->get();
        return view('frontend.bank.index',compact('banks'));
    }
    public function bankEdit($id){
        return $data = Bank::with('bankTrans')->find($id);
    }
    public function bankStore(Request $request){
        $this->validate($request,[
            'bank_name' => 'required',
            'account_name' => 'required',
            'branch' => 'required',
            'type' => 'required',
            'number' => 'required',
            'entry_date' => 'required',
        ]);
        $addBank = new Bank();
        $addBank->bank_name  = $request->bank_name;
        $addBank->account_name  = $request->account_name;
        $addBank->branch  = $request->branch;
        $addBank->type  = $request->type;
        $addBank->number  = $request->number;
        $addBank->entry_date  = $request->entry_date;
        $addBank->save();
        $debit=0; $credit=0;
        if (is_numeric($request->debit)){
            $debit=$request->debit;
        }
        if (is_numeric($request->credit)){
            $credit=$request->credit;
        }
        if ($debit > 0 || $credit > 0){
//            $addCustomer->id
            $dBTrans = new BankTransaaction();
            $dBTrans->bank_id = $addBank->id;
            $dBTrans->debit = $debit;
            $dBTrans->credit = $credit;
            $dBTrans->entry_date = $request->entry_date;
            $dBTrans->type = 'OPENING BALANCE';
            $dBTrans->save();
        }
        return redirect()->back()->with('message','Bank Add success');
    }
    public function bankUpdate(Request $request){
        $this->validate($request,[
            'bank_name' => 'required',
            'account_name' => 'required',
            'branch' => 'required',
            'type' => 'required',
            'number' => 'required',
            'entry_date' => 'required',
        ]);
        $updateBank = Bank::with('bankTrans')->find($request->id);
        $updateBank->bank_name  = $request->bank_name;
        $updateBank->account_name  = $request->account_name;
        $updateBank->branch  = $request->branch;
        $updateBank->type  = $request->type;
        $updateBank->number  = $request->number;
        $updateBank->entry_date  = $request->entry_date;
        $updateBank->save();
        $debit=0; $credit=0;
        if (is_numeric($request->debit)){
            $debit=$request->debit;
        }
        if (is_numeric($request->credit)){
            $credit=$request->credit;
        }
        if ($debit > 0 || $credit > 0){
            foreach ($updateBank->bankTrans as $uBank){
                $uBank->debit = $debit;
                $uBank->credit = $credit;
                $uBank->entry_date = $request->entry_date;
                $uBank->type = 'OPENING BALANCE';
                $uBank->save();
            }
        }
        return redirect()->back()->with('message','Bank Update success');
    }
    public function bankView($id){
        $bankDetail = Bank::find($id);
        $transDetails = BankTransaaction::where('bank_id',$id)->get();
        $debit = BankTransaaction::where('bank_id',$id)->sum('debit');
        $credit = BankTransaaction::where('bank_id',$id)->sum('credit');
        return view('frontend.bank.bankDetail',compact('bankDetail','transDetails','debit','credit'));
    }
    public function bankDelete($id){
        $bankDelete=Bank::with('bankTrans')->find($id);
    }
}
