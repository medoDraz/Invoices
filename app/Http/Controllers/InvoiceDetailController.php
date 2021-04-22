<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetail;
use App\Models\InvoiceAttachment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class InvoiceDetailController extends Controller
{
    
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(InvoiceDetail $invoiceDetail)
    {
        //
    }

   
    public function edit($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details  = InvoiceDetail::where('id_Invoice',$id)->get();
        $attachments  = InvoiceAttachment::where('invoice_id',$id)->get();
        // return $details;
        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    
    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        //
    }

    
    public function destroy(Request $request)
    {
        $invoices = InvoiceAttachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

     public function get_file($invoice_number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($invoice_number,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
}
