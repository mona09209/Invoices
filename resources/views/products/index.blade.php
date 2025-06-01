@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
  <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" />

@endsection
@section('title')
    المنتجات
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="my-auto mb-0 content-title">الاعدادات</h4><span class="mt-1 mb-0 mr-2 text-muted tx-13">/
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@include('layouts.alerts.messages')

  <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="pb-0 card-header">
                    <div class="d-flex justify-content-between">
                        <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mg-sm-t-0">
                            @can('اضافة منتج')
                            <a class="modal-effect btn btn-outline-primary " data-effect="effect-scale"
                                data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus"></i>&nbsp;اضافة منتج</a>
                                @endcan
                            </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'  style="width: 99.5%">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المنتج</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Products as $index =>  $Product )

											<tr>
                                                <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Product->name }}</td>
                                        <td>{{ $Product->section->name }}</td>
                                        <td>{{ $Product->description }}</td>
                                        <td>
                                            @can('تعديل منتج')
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    pro_id="{{ $Product->id }}" data-name="{{ $Product->name }}"
                                                    data-description="{{ $Product->description }}" data-toggle="modal"
                                                    href="#edit_Product" title="تعديل"><i class="las la-pen"></i></a>
                                                    @endcan

                                                    @can('حذف منتج')
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                pro_id="{{ $Product->id }}"
                                                data-product_name="{{ $Product->name }}" data-toggle="modal"
                                                data-target="#modaldemo9" title="حذف"><i
                                                        class="las la-trash"></i></a>
                                                    @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @include('products.AddModal')
                            @include('products.EditModal')
                            @include('products.DeleteModal')
                        </table>
                    </div>
                </div>
            </div>
        </div>






    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
     <!--Internal  Notify js -->
 <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>


    <script>
        // JavaScript for Edit Modal
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var pro_id = button.attr('pro_id');
            var name = button.data('name');
            var description = button.data('description');

            var modal = $(this);
            modal.find('#pro_id').val(pro_id);
            modal.find('#Product_name').val(name);
            modal.find('#description').val(description);

            // Update form action dynamically
            var form = modal.find('#editProductForm');
            var actionUrl = '{{ route("Products.update", ":id") }}'.replace(':id', pro_id);
            form.attr('action', actionUrl);
        });

        // JavaScript for Delete Modal
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var pro_id = button.attr('pro_id'); // Extract product ID from data-* attributes
            var product_name = button.data('product_name'); // Extract product name

            var modal = $(this);
            modal.find('.modal-body #pro_id').val(pro_id); // Set product ID in hidden input
            modal.find('.modal-body #product_name').val(product_name); // Set product name in input field

            // Update form action dynamically
            var form = modal.find('#deleteProductForm');
            var actionUrl = '{{ route("Products.destroy", ":id") }}'.replace(':id', pro_id);
            form.attr('action', actionUrl); // Set the form's action to the correct delete route
        });
    </script>


@endsection
