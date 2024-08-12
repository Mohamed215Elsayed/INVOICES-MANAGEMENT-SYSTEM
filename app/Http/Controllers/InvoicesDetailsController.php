<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Models\invoices;
use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
class InvoicesDetailsController extends Controller
{
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $details = invoices_Details::where('id_Invoice', $id)->get();
        $attachments = invoice_attachments::where('invoice_id', $id)->get();
        return view('invoices.details_invoice', compact('invoices', 'details', 'attachments'));
    }

    // public function destroy(Request $request)
    // {
    //     $invoices = invoice_attachments::findOrFail($request->id_file);
    //     $invoices->delete();
    //     Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
    //     Session::flash('delete', 'تم حذف المرفق بنجاح');
    //     return back();
    // }

public function destroy(Request $request)
{
    try {
        $attachment = invoice_attachments::findOrFail($request->id_file);
        $attachment->delete();

        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);

        Session::flash('delete', 'تم حذف المرفق بنجاح');
    } catch (\Exception $e) {
        // Handle any potential errors here
        Session::flash('error', 'Failed to delete attachment');
        Log::error('Failed to delete attachment: ' . $e->getMessage());
    }

    return back();
}
    public function open_file($invoice_number, $file_name)
    {
        $disk = Storage::disk('public_uploads');
        $filePath = "{$invoice_number}/{$file_name}";
        return response()->file($disk->path($filePath));
    }

    public function get_file($invoice_number, $file_name)
    {
        $disk = Storage::disk('public_uploads');
        $filePath = "{$invoice_number}/{$file_name}";

        if ($disk->exists($filePath)) {
            return response()->download($disk->path($filePath));
        } else {
            abort(404, 'File not found.');
        }
    }
    
    // public function open_file($invoice_number, $file_name)
    // {
    //     $files = Storage::disk('public_uploads')->getAdapter()->applyPathPrefix("{$invoice_number}/{$file_name}");
    //     return response()->file($files);
    // }

}
