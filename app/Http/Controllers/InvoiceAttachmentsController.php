<?php

namespace App\Http\Controllers;

use App\Models\Invoice_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoiceAttachmentsController extends Controller
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
        try {
            // التحقق من صحة البيانات
            $this->validate($request, [
                'file_name' => 'required|mimes:pdf,jpeg,png,jpg',
            ], [
                'file_name.mimes' => 'صيغة المرفق يجب أن تكون pdf, jpeg, png, jpg',
            ]);

            // الحصول على الملف المرفوع
            $file = $request->file('file_name');
            $file_name = $file->getClientOriginalName();

            // حفظ تفاصيل المرفق في قاعدة البيانات
            $attachments = new Invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $request->invoice_number;
            $attachments->invoice_id = $request->invoice_id;
            $attachments->created_by = Auth::user()->name;
            $attachments->save();

            // نقل الملف إلى المجلد المطلوب
            $file->move(public_path('Attachments/' . $request->invoice_number), $file_name);

            // رسالة نجاح
            session()->flash('add', 'تم إضافة المرفق بنجاح');
        } catch (\Exception $e) {
            // رسالة خطأ
            session()->flash('error', 'حدث خطأ أثناء رفع المرفق: ' . $e->getMessage());
        }

        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice_attachments $invoice_attachments)
    {
        //
    }
}
