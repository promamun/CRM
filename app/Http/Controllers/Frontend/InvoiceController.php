<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankTransaaction;
use App\Models\Customer;
use App\Models\InvoiceItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoiceCreate(){
        $customers =Customer::orderBy('created_at','desc')->get();
        $banks =Bank::orderBy('created_at','desc')->get();
        return view('frontend.invoice.index',compact('customers','banks'));
    }
    public function invoiceStore(Request $request){
        try {
            $this->validate($request,[
                'unit' => 'required',
                'item' => 'required',
                'size' => 'required',
                'width' => 'required',
                'height' => 'required',
                'square_ft' => 'required',
                'rate' => 'required',
                'total_price' => 'required',
            ]);
            $debit=0; $credit=0;
            if (is_numeric($request->sub_price)){
                $debit=$request->sub_price;
            }
            if (is_numeric($request->credit)){
                $credit=$request->credit;
            }
            if ($debit > 0 || $credit > 0) {
                $dBTrans = new Transaction();
                $dBTrans->ledger_id = $request->customer_id;
                $dBTrans->debit = $debit;
                $dBTrans->credit = $credit;
                $dBTrans->entry_date = $request->date;
                $dBTrans->type = 'INVOICE';
                $dBTrans->description = $request->description;
                $dBTrans->bank = $request->payment_type;
                $dBTrans->save();
                if ($dBTrans->save()){
                    foreach ($request->item as $key=> $invoiceItems){
                        $iItemsStore = new InvoiceItem();
                        $iItemsStore->trans_id = $dBTrans->id;
                        $iItemsStore->item = $request->item[$key];
                        $iItemsStore->size = $request->size[$key];
                        $iItemsStore->unit = $request->unit[$key];
                        $iItemsStore->width = $request->width[$key];
                        $iItemsStore->height = $request->height[$key];
                        $iItemsStore->square_ft = $request->square_ft[$key];
                        $iItemsStore->rate = $request->rate[$key];
                        $iItemsStore->total_price = $request->total_price[$key];
                        $iItemsStore->save();
                    }
                }
            }
            return redirect()->back()->with('message','Invoice Create Success');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function invoiceUpdate(Request $request,$id){
//        dd($request->all());
        try {
            $this->validate($request,[
                'unit' => 'required',
                'item' => 'required',
                'size' => 'required',
                'width' => 'required',
                'height' => 'required',
                'square_ft' => 'required',
                'rate' => 'required',
                'total_price' => 'required',
            ]);
//            if ($request->invoiceItems_id){

                $debit=0; $credit=0;
                if (is_numeric($request->sub_price)){
                    $debit=$request->sub_price;
                }
                if (is_numeric($request->credit)){
                    $credit=$request->credit;
                }
                if ($debit > 0 || $credit > 0) {
                    $dBTransUpdate = Transaction::with('invoiceItems')->find($request->trans_id);
                    $dBTransUpdate->ledger_id = $request->customer_id;
                    $dBTransUpdate->debit = $debit;
                    $dBTransUpdate->credit = $credit;
                    $dBTransUpdate->entry_date = $request->entry_date;
                    $dBTransUpdate->type = 'INVOICE';
                    $dBTransUpdate->description = $request->description;
                    $dBTransUpdate->bank = $request->bank;
                    $dBTransUpdate->save();
                    if ($dBTransUpdate->save()){
                        foreach ($dBTransUpdate->invoiceItems as $destroy){
                            $destroy->delete();
                        }
                        foreach ($request->item as $key=> $invoiceItems){
                            $iItemsStore = new InvoiceItem();
                            $iItemsStore->trans_id = $request->trans_id;
                            $iItemsStore->item = $request->item[$key];
                            $iItemsStore->size = $request->size[$key];
                            $iItemsStore->unit = $request->unit[$key];
                            $iItemsStore->width = $request->width[$key];
                            $iItemsStore->height = $request->height[$key];
                            $iItemsStore->square_ft = $request->square_ft[$key];
                            $iItemsStore->rate = $request->rate[$key];
                            $iItemsStore->total_price = $request->total_price[$key];
                            $iItemsStore->save();
                        }
                    }
                }
            return redirect()->back()->with('message','Invoice Update Success');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function invoiceEdit($id){
        $customers =Customer::orderBy('created_at','desc')->get();
        $invoiceItems = Transaction::with('invoiceItems')->find($id);
        return view('frontend.invoice.editInvoice',compact('customers','invoiceItems'));
    }
    public function invoiceDelete($id){
        $invoiceDelete = Transaction::with('invoiceItems')->find($id);
        foreach ($invoiceDelete->invoiceItems as $delete){
            $delete->delete();
        }
        $invoiceDelete->delete();
        return redirect()->back()->with('message','Invoice Delete Success');
    }
    public function invoiceList(){
        $transDetails = Transaction::where('type','INVOICE')->orderBy('created_at','desc')->get();
        return view('frontend.invoice.listInvoice',compact('transDetails'));
    }

    ///daily entry manage controller
    public function entryCreate(){
        $customers =Customer::orderBy('created_at','desc')->get();
        $banks =Bank::orderBy('created_at','desc')->get();
        return view('frontend.entry.index',compact('customers','banks'));
    }
    public function entryStore(Request $request){
//        dd($request->all());
        try {
//            $this->validate($request,[
//                'debit' => 'required',
//                'credit' => 'required',
//            ]);
            $debit=0; $credit=0;
            if (is_numeric($request->debit)){
                $debit=$request->debit;
            }
            if (is_numeric($request->credit)){
                $credit=$request->credit;
            }
            if ($debit > 0 || $credit > 0) {
                if ($request->type === 'Customer'){
//                    dd($request->all());
                    $dBTrans = new Transaction();
                    $dBTrans->ledger_id = $request->profile_id;
                    $dBTrans->debit = $debit;
                    $dBTrans->credit = $credit;
                    $dBTrans->entry_date = $request->entry_date;
                    $dBTrans->type = 'DAILY ENTRY';
                    $dBTrans->description = $request->description;
                    $dBTrans->bank = $request->bank;
                    $dBTrans->save();
                }elseif ($request->type === 'Supplier'){
                    $dBTrans = new Transaction();
                    $dBTrans->ledger_id = $request->profile_id;
                    $dBTrans->debit = $debit;
                    $dBTrans->credit = $credit;
                    $dBTrans->entry_date = $request->date;
                    $dBTrans->type = 'DAILY ENTRY';
                    $dBTrans->description = $request->description;
                    $dBTrans->bank = $request->bank;
                    $dBTrans->save();
                }elseif ($request->type === 'Bank'){
                    $dBTrans = new BankTransaaction();
                    $dBTrans->bank_id = $request->profile_id;
                    $dBTrans->debit = $debit;
                    $dBTrans->credit = $credit;
                    $dBTrans->entry_date = $request->entry_date;
                    $dBTrans->type = 'DAILY ENTRY';
                    $dBTrans->save();
                }
            }
            return redirect()->back()->with('message','Entry Success');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function entryUpdate(Request $request,$id){
//        dd($request->all());
        try {
            $this->validate($request,[
                'unit' => 'required',
                'item' => 'required',
                'size' => 'required',
                'width' => 'required',
                'height' => 'required',
                'square_ft' => 'required',
                'rate' => 'required',
                'total_price' => 'required',
            ]);
//            if ($request->invoiceItems_id){

            $debit=0; $credit=0;
            if (is_numeric($request->sub_price)){
                $debit=$request->sub_price;
            }
            if (is_numeric($request->credit)){
                $credit=$request->credit;
            }
            if ($debit > 0 || $credit > 0) {
                $dBTransUpdate = Transaction::with('invoiceItems')->find($request->trans_id);
                $dBTransUpdate->ledger_id = $request->customer_id;
                $dBTransUpdate->debit = $debit;
                $dBTransUpdate->credit = $credit;
                $dBTransUpdate->entry_date = $request->entry_date;
                $dBTransUpdate->type = 'INVOICE';
                $dBTransUpdate->description = $request->description;
                $dBTransUpdate->bank = $request->bank;
                $dBTransUpdate->save();
                if ($dBTransUpdate->save()){
                    foreach ($dBTransUpdate->invoiceItems as $destroy){
                        $destroy->delete();
                    }
                    foreach ($request->item as $key=> $invoiceItems){
                        $iItemsStore = new InvoiceItem();
                        $iItemsStore->trans_id = $request->trans_id;
                        $iItemsStore->item = $request->item[$key];
                        $iItemsStore->size = $request->size[$key];
                        $iItemsStore->unit = $request->unit[$key];
                        $iItemsStore->width = $request->width[$key];
                        $iItemsStore->height = $request->height[$key];
                        $iItemsStore->square_ft = $request->square_ft[$key];
                        $iItemsStore->rate = $request->rate[$key];
                        $iItemsStore->total_price = $request->total_price[$key];
                        $iItemsStore->save();
                    }
                }
            }
            return redirect()->back()->with('message','Invoice Update Success');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function entryEdit($id){
        $customers =Customer::orderBy('created_at','desc')->get();
        $invoiceItems = Transaction::with('invoiceItems')->find($id);
        return view('frontend.invoice.editInvoice',compact('customers','invoiceItems'));
    }
    public function entryDelete($id){
        $invoiceDelete = Transaction::with('invoiceItems')->find($id);
        foreach ($invoiceDelete->invoiceItems as $delete){
            $delete->delete();
        }
        $invoiceDelete->delete();
        return redirect()->back()->with('message','Invoice Delete Success');
    }
    public function entryList(){
        $transDetails = Transaction::where('type','DAILY ENTRY')->orderBy('created_at','desc')->get();
        return view('frontend.entry.listEntry',compact('transDetails'));
    }
}
