<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
use Illuminate\Support\Facades\Session;
class InvoiceAchiveController extends Controller
{
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('Invoices.Archive_Invoices',compact('invoices'));
    }

    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $flight = Invoices::withTrashed()->where('id', $id)->restore();
        Session::flash('restore_invoice');
        return redirect('/getall_invoices');
    }

    public function destroy(Request $request)
    {
        $invoices = invoices::withTrashed()->where('id',$request->invoice_id)->first();
        $invoices->forceDelete();
        Session::flash('delete_invoice');
        return redirect('/Archive');
    }
}

