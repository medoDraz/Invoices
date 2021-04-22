<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoiceAttachment;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Notification;
// use App\Notifications\AddInvoice;
// use App\Exports\InvoicesExport;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Events\MyEventClass;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }


    public function create()
    {
        // $products = Product::all();
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {
        // return $request->file('pic')->getClientOriginalName();
        DB::beginTransaction();
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        InvoiceDetail::create([
            'id_Invoice' => $invoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            InvoiceAttachment::create([
                'file_name' =>  $file_name,
                'invoice_number' => $invoice_number,
                'Created_by' => Auth::user()->name,
                'invoice_id' => $invoice->id,
            ]);

            // $attachments = new InvoiceAttachment();
            // $attachments->file_name = $file_name;
            // $attachments->invoice_number = $invoice_number;
            // $attachments->Created_by = Auth::user()->name;
            // $attachments->invoice_id = $invoice->id;
            // $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // $user = User::first();
        // Notification::send($user, new AddInvoice($invoice_id));

        //    $user = User::get();
        //    $invoices = invoices::latest()->first();
        //    Notification::send($user, new \App\Notifications\Add_invoice_new($invoices));
   
        //    event(new MyEventClass('hello world'));
        DB::commit();
        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
        
    }

    public function show(Invoice $invoice)
    {
        //
    }


    public function edit(Invoice $invoice)
    {
        //
    }


    public function update(Request $request, Invoice $invoice)
    {
        //
    }


    public function destroy(Invoice $invoice)
    {
        //
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }
}
