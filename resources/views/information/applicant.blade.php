@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Informasi')

@section('contentheader_description', 'Manajemen Pelamar Lowongan')

@section('contentheader_title', 'Manajemen Informasi')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-editable.css') }}"/>
@stop

@section('main-content')
<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
<div class="box box-warning">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">{{ $information->title }}</h3>
		<p><i>{{ $information->created_at->format('d F Y') }}</i> oleh <i>{{ $information->user->name }}</i></p>
	</div>

	<div class="box-body">
		<table id="table_id" class="table table-striped table-bordered" cellspacing="0">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Email</th>					
					<th>Telepon</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($information->applicant as $applicant)
				<tr>
					<td><a href="{{ url('/admin/cv/'.$applicant->id) }}" target="_blank">{{ $applicant->name }}</a></td>
					<td>{{ $applicant->email }}</td>
					<td>{{ $applicant->phone }}</td>
					<td><a href="#" class="edit"				
						data-type="select"						
						data-pk="{{ $applicant->id }}"
						data-url="{{ url('/admin/ubahstatus/'.$information->id) }}"
						data-source='{"Ditolak": "Ditolak","Diterima": "Diterima", "Menunggu": "Menunggu"}'>{{ $applicant->pivot->status }}</a></td>
					<td><center><a href="#" class="btn btn-danger btn flat btnhapus" title="Hapus"
						data-id={{ $applicant->id }}
						data-name={{ $applicant->name }}>Hapus <i class="fa fa-trash"></i></a></center></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div id="hapus" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Data Pelamar</h4>
			</div>			
			<div class="modal-body">
				<p>Hapus data pelamar <span class="nama"><b></b></span> ??</p>
			</div>
			<div class="modal-footer">
				{!! Form::open(['class' => 'frm', 'method' => 'DELETE']) !!}
					<button type="submit" class="btn btn-danger btn-flat">Hapus <i class="fa fa-trash"></i></button>					
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')    
	@include('layouts.partials.scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('/js/bootstrap-editable.min.js') }}"></script>
	<script type="text/javascript">
	   	$.fn.editable.defaults.params = function (params) 
	   	{
	    	params._token = $("#_token").data("token");
	    	
	    	return params;
	   	};
   		
   		$(".edit").editable();

		$('#table_id').dataTable({
			"oLanguage":{
				"sZeroRecords": "Tidak ada data yang cocok.",
				"sEmptyTable": "Data kosong",
				"sSearch": "Cari nama",
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

		$('.btnhapus').click(function () {
			$('#hapus').modal('show');
			$('.nama b').html($(this).data('name'));
			$('.frm').attr('action', '{{ url('/admin/pelamar/'.$information->id) }}/'+$(this).data('id'));
		});	
	</script>
@stop