<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceAchiveController extends Controller
{
    public function index(){
        $invoices = Invoice::onlyTrashed()->get();
        //onlyTrashed = (deleted_at != null)
        return view('invoices.Archive_Invoices',compact('invoices'));
    }
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $flight = Invoices::withTrashed()->where('id', $id)->restore();
        //restore = (deleted_at == null)
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
        $invoices = invoices::withTrashed()->where('id',$request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Archive');

    }
}
