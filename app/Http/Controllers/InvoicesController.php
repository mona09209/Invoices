<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Notifications\add_invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sections;
use App\Models\User;
use App\Models\Invoice_attachments;
use App\Models\Invoices_details;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;


class InvoicesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    public function export()
    {
        return Excel::download(new InvoiceExport, 'Invoice.xlsx');
    }

    public function index()
    {
        $invoices = Invoice::get();
       return view('invoices.index',compact('invoices'));
    }


    public function create()
    {
        $sections = Sections::whereHas('products')->get();
        return view('invoices.add_invoice',compact('sections'));
    }

    public function getproducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('name', 'id');
        return json_encode($products);
    }

    public function store(Request $request)
{
    try {
        // التحقق مما إذا كان رقم الفاتورة موجودًا بالفعل
        $existingInvoice = Invoice::where('invoice_number', $request->invoice_number)->first();

        if ($existingInvoice) {
            session()->flash('error', 'رقم الفاتورة موجود مسبقًا!');
            return redirect()->route('Invoices.index');
        }

        // إنشاء الفاتورة إذا لم تكن موجودة
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
        ]);

        // إدراج التفاصيل المرتبطة بالفاتورة
        Invoices_details::create([
            'invoice_id' => $invoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
            'created_by' => Auth::user()->name,
        ]);

        // معالجة المرفقات
        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new Invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice->id;
            $attachments->save();

            // نقل الملف إلى مجلد المرفقات
            $request->pic->move(public_path('Attachments/' . $invoice_number), $file_name);
        }

        $user = User::first(); 
        Notification::send($user, new add_invoice($invoice->id));

        session()->flash('add', 'تم إضافة الفاتورة بنجاح');
    } catch (\Exception $e) {
        session()->flash('error', 'حدث خطأ أثناء إضافة الفاتورة: ' . $e->getMessage());
    }

    return redirect()->route('Invoices.index');
}



    public function show($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.status_update',compact('invoices'));
    }


    public function edit($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $sections = Sections::get();
        return view('invoices.edit_invoice',compact('invoices', 'sections'));
    }


    public function update(Request $request)
    {
        try {
            // البحث عن الفاتورة
            $invoice = Invoice::findOrFail($request->invoice_id);

            // تحديث بيانات الفاتورة
            $invoice->update([
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'product' => $request->product,
                'section_id' => $request->section_id,
                'amount_collection' => $request->amount_collection,
                'amount_commission' => $request->amount_commission,
                'discount' => $request->discount,
                'value_vat' => $request->value_vat,
                'rate_vat' => $request->rate_vat,
                'total' => $request->total,
                'note' => $request->note,
            ]);

             // تحديث تفاصيل الفاتورة
        $invoiceDetails = Invoices_details::where('invoice_id', $request->invoice_id)->first();
        if ($invoiceDetails) {
            $invoiceDetails->update([
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section_id' => $request->section_id,
                'note' => $request->note,
                'created_by' => Auth::user()->name,
            ]);
        }

            session()->flash('edit', 'تم تحديث الفاتورة بنجاح');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء تحديث الفاتورة: ' . $e->getMessage());
        }

        return redirect()->route('Invoices.index');
    }


    public function Status_update($id, Request $request)
    {
        $invoices = Invoice::findOrFail($id);

        if ($request->status === 'مدفوعة') {

            $invoices->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);

            invoices_Details::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section_id' => $request->section_id,
                'status' => $request->status,
                'value_status' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'created_by' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);
            invoices_Details::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section_id' => $request->section_id,
                'status' => $request->status,
                'value_status' => 3,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'created_by' => (Auth::user()->name),
            ]);
        }
        session()->flash('status_update');
        return redirect('/Invoices');

    }


    public function invoice_paid()
    {
        $invoices = Invoice::where('value_status', 1)->get();
        return view('invoices.invoice_paid',compact('invoices'));
    }

    public function invoice_unpaid()
    {
        $invoices = Invoice::where('value_status',2)->get();
        return view('invoices.invoice_unpaid',compact('invoices'));
    }

    public function invoice_partial()
    {
        $invoices = Invoice::where('value_status',3)->get();
        return view('invoices.invoice_partial',compact('invoices'));
    }

    public function print_invoice($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.print_invoice',compact('invoices'));
    }

    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }


    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification){

return $notification->data['title'];

        }

    }
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoice::where('id', $id)->first();
        $Details = Invoice_attachments::where('invoice_id', $id)->first();

         $id_page =$request->id_page;


        if (!$id_page==2) {

        if (!empty($Details->invoice_number)) {

            Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
        }

        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Invoices');

        }

        else {

            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');

        }


    }
}
