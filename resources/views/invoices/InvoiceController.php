<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
        return view('invoices.index', compact('invoices'));
    }


    public function create()
    {
        // $products = Product::all();
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {
        //
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
