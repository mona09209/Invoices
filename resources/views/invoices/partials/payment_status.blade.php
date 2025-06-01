<div class="table-responsive mt-15">
    <table class="table center-aligned-table mb-0 table-hover" style="text-align:center">
        <thead>
            <tr class="text-dark">
                <th>#</th>
                <th>رقم الفاتورة</th>
                <th>نوع المنتج</th>
                <th>القسم</th>
                <th>حالة الدفع</th>
                <th>تاريخ الدفع</th>
                <th>ملاحظات</th>
                <th>تاريخ الاضافة</th>
                <th>المستخدم</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($details as $i => $detail)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $detail->invoice_number }}</td>
                    <td>{{ $detail->product }}</td>
                    <td>{{ $invoice->section->name }}</td>
                    <td>
                        @if ($detail->value_status == 1)
                            <span class="badge badge-pill badge-success">{{ $detail->status }}</span>
                        @elseif($detail->value_status == 2)
                            <span class="badge badge-pill badge-danger">{{ $detail->status }}</span>
                        @else
                            <span class="badge badge-pill badge-warning">{{ $detail->status }}</span>
                        @endif
                    </td>
                    <td>{{ $detail->payment_date }}</td>
                    <td>{{ $detail->note }}</td>
                    <td>{{ $detail->created_at }}</td>
                    <td>{{ $detail->created_by }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">لا توجد بيانات</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
