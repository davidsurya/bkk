@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Jurusan')

@section('contentheader_description', 'Mengelola jurusan')

@section('contentheader_title', 'Manajemen Jurusan')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}"/>
{{--<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-editable.css') }}">--}}
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
@stop

@section('main-content')
<div class="box box-warning">
	@include('program.partials.prodi')
</div>

@include('program.partials.modalprodi')
@stop

@section('scripts')
@include('layouts.partials.scripts')
<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
{{-- <script type="text/javascript" charset="utf8" src="{{ asset('/js/bootstrap-editable.min.js') }}"></script> --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('#tabel_prodi').dataTable({
			"oLanguage":{
				"sZeroRecords": "Tidak ada data yang cocok.",
				"sEmptyTable": "Data kosong, silahkan tambah data terlebih dahulu.",
				"sSearch": "Cari jurusan",
				"sLengthMenu": "_MENU_ per halaman",
				"sInfo": 'Total _MAX_ data.',
				"sInfoEmpty": "Data tidak ditemukan.",	    			
				"sInfoFiltered": "",
				"oPaginate": {
					"sPrevious": "Sebelumnya",
					"sNext": "Selanjutnya",
				}
			}
		});
	});

	$('#btntambahprodi').click(function(){
		$('#tambahprodi').modal('show');		
		$('.frm').attr('action', '{{ url('/admin/prodi') }}');
	});

	$('.editprodi').click(function(){
		$('#editprodi').modal('show');
		$('#namaprodi').val($(this).data('name'));
		$('#namajurusan').val($(this).data('subdepartment'));
		$('.frm').attr('action', '{{ url('/admin/prodi') }}/'+$(this).data('id'));
	});

	$('.hapusprodi').click(function(){
		$('#hapusprodi').modal('show');
		$('#nama b').html($(this).data('name'));
		$('.frm').attr('action', '{{ url('/admin/prodi') }}/'+$(this).data('id'));
	});
	

	$('.study_id').click(function(){
		$('.frm').attr('action', '{{ url('/admin/jurusan') }}'+$(this).val());
	});

	toastr.options = {
		"closeButton": true,
	}

	@if (Session::has('msgInfo'))

	toastr.success("{{ Session::get('msgInfo') }}");

	@elseif(Session::has('msgError'))

	toastr.error("{{ Session::get('msgError') }}");

	@endif

	@if (count($errors) > 0)

		@foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach

	@endif
</script>
@stop