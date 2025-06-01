@extends('layouts.master')
@section('title')
   الأقسام
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
 <!--Internal   Notify -->
 <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
 <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="my-auto mb-0 content-title">الإعدادات</h4><span class="mt-1 mb-0 mr-2 text-muted tx-13">/  الأقسام</span>
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
						<div class="card">
							<div class="pb-0 card-header">
								<div class="d-flex justify-content-between">

									<div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mg-sm-t-0">
                                        @can('اضافة قسم')
										<a class="modal-effect btn btn-outline-primary" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus"></i>&nbsp;إضافة قسم </a>
                                    @endcan
                                    </div>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table key-buttons text-md-nowrap" id="example1" style="width: 99.5%">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> إسم القسم</th>
                                                <th class="border-bottom-0"> الوصف</th>
												<th class="border-bottom-0"> العمليات</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach ($sections as $index =>  $section)

											<tr>
                                                <td>{{ $loop->iteration }}</td>
												<td>{{ $section->name }}</td>
												<td>{{ $section->description }}</td>
                                                <td>
                                                    @can('تعديل قسم')
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-id="{{ $section->id }}" data-name="{{ $section->name }}"
                                                            data-description="{{ $section->description }}" data-toggle="modal"
                                                            href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>
                                                            @endcan

                                                            @can('حذف قسم')
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-id="{{ $section->id }}" data-name="{{ $section->name }}"
                                                            data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                                class="las la-trash"></i></a>
                                                             @endcan
                                                </td>
											</tr>
											@endforeach
										</tbody>
                                        @include('sections.AddSectionModal')
                                        @include('sections.EditSectionModal')
                                        @include('sections.DeleteSectionModal')
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
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
 <!--Internal  Notify js -->
 <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #description').val(description);
    })

</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })

</script>
@endsection
