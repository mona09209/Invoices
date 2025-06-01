@extends('layouts.master')

@section('css')
    <!---Internal Prism css-->
    <link href="{{ asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!---Custom-scroll -->
    <link href="{{ asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection

@section('title', 'تفاصيل فاتورة')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
 @include('layouts.alerts.messages')

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <!-- Invoice Information Tab -->
                                        <div class="tab-pane active" id="tab4">
                                            @include('invoices.partials.invoice_info', ['invoice' => $invoices])
                                        </div>

                                        <!-- Payment Status Tab -->
                                        <div class="tab-pane" id="tab5">
                                            @include('invoices.partials.payment_status', ['details' => $details, 'invoice' => $invoices])
                                        </div>

                                        <!-- Attachments Tab -->
                                        <div class="tab-pane" id="tab6">
                                            <div class="card card-statistics">

                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{ url('/Attachments') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile" name="file_name" required>
                                                                <input type="hidden" name="invoice_number" value="{{ $invoices->invoice_number }}">
                                                                <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد المرفق</label>
                                                            </div>
                                                            <br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm" name="uploadedFile">تأكيد</button>
                                                        </form>
                                                    </div>

                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table-hover" style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">#</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($attachments as $i => $attachment)
                                                                <tr>
                                                                    <td>{{ $i + 1 }}</td>
                                                                    <td>{{ $attachment->file_name }}</td>
                                                                    <td>{{ $attachment->created_by }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    <td colspan="2">
                                                                        <a class="btn btn-success btn-sm" href="{{ url('view_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}" role="button">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                        <a class="btn btn-info btn-sm" href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}" role="button">
                                                                            <i class="fas fa-download"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_file"
                                                                            data-id="{{ $attachment->id }}"
                                                                            data-file_name="{{ $attachment->file_name }}"
                                                                            data-invoice_number="{{ $attachment->invoice_number }}">
                                                                            <i class="las la-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">لا توجد مرفقات</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- Delete Attachment Modal -->
    @include('invoices.partials.delete_attachment_modal')
@endsection

@section('js')
    <!--Internal Datepicker js -->
    <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ asset('assets/js/tabs.js') }}"></script>
    <!--Internal Clipboard js-->
    <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        // Delete Attachment Modal
        $('#delete_file').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const modal = $(this);
            modal.find('.modal-body #id').val(button.data('id'));
            modal.find('.modal-body #file_name').val(button.data('file_name'));
            modal.find('.modal-body #invoice_number').val(button.data('invoice_number'));
        });

        // File Input Label
        $(".custom-file-input").on("change", function() {
            const fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
