<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_attachments;
use App\Models\Invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class InvoicesDetailsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $details = Invoices_details::where('invoice_id', $id)->get();
        $attachments = Invoice_attachments::where('invoice_id', $id)->get();
        return view('invoices.invoice_details', compact('attachments', 'details', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_details $invoices_details)
    {
        //
    }

    public function get_file($invoice_number, $file_name)
    {
        $path = Storage::disk('public_uploads')->path($invoice_number . '/' . $file_name);

        // Check if the file exists
        if (!Storage::disk('public_uploads')->exists($invoice_number . '/' . $file_name)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }

    public function open_file($invoice_number, $file_name)
    {
        $path = Storage::disk('public_uploads')->path($invoice_number . '/' . $file_name);

        // Check if the file exists
        if (!Storage::disk('public_uploads')->exists($invoice_number . '/' . $file_name)) {
            abort(404, 'File not found');
        }

        return response()->file($path);
    }

    public function destroy(Request $request)
    {
        $invoices = Invoice_attachments::findOrFail($request->id);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
