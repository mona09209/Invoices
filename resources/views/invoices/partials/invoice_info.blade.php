<div class="table-responsive mt-15">
    <table class="table table-striped" style="text-align:center">
        <tbody>
            <tr>
                <th scope="row">رقم الفاتورة</th>
                <td>{{ $invoice->invoice_number }}</td>
                <th scope="row">تاريخ الاصدار</th>
                <td>{{ $invoice->invoice_date }}</td>
                <th scope="row">تاريخ الاستحقاق</th>
                <td>{{ $invoice->due_date }}</td>
                <th scope="row">القسم</th>
                <td>{{ $invoice->section->name }}</td>
            </tr>
            <tr>
                <th scope="row">المنتج</th>
                <td>{{ $invoice->product }}</td>
                <th scope="row">مبلغ التحصيل</th>
                <td>{{ $invoice->amount_collection }}</td>
                <th scope="row">مبلغ العمولة</th>
                <td>{{ $invoice->amount_commission }}</td>
                <th scope="row">الخصم</th>
                <td>{{ $invoice->discount }}</td>
            </tr>
            <tr>
                <th scope="row">نسبة الضريبة</th>
                <td>{{ $invoice->rate_vat }}</td>
                <th scope="row">قيمة الضريبة</th>
                <td>{{ $invoice->value_vat }}</td>
                <th scope="row">الاجمالي مع الضريبة</th>
                <td>{{ $invoice->total }}</td>
                <th scope="row">الحالة الحالية</th>
                <td>
                    @if ($invoice->value_status == 1)
                        <span class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                    @elseif($invoice->value_status == 2)
                        <span class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                    @else
                        <span class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th scope="row">ملاحظات</th>
                <td>{{ $invoice->note }}</td>
            </tr>
        </tbody>
    </table>
</div>
