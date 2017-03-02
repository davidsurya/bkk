@extends('layouts.app')

@section('htmlheader_title', 'Informasi Lowongan')

@section('contentheader_title', 'Informasi Lowongan')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}"/>
@stop

@section('main-content')
<br>
<div class="row">
	<div class="col-sm-8">
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-list"></i>
				<h3 class="box-title">Lowongan yang telah dilamar</h3>				
			</div>
			
			<div class="box-body">
				<table id="table_id" class="table table-striped table-bordered" cellspacing="0">
					<thead>
						<tr>			
							<th>Nama Lowongan</th>										
							<th>Tanggal Lamaran</th>
							<th>Status</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($proposals as $proposal)
						<tr>
							<td>{{ $proposal->title }}</td>
							<?php $date = new Date($proposal->pivot->created_at); ?>						
							<td>{{ $date->format('d F Y') }}</td>
							<td>{{ $proposal->pivot->status }}</td>							
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>		
	</div>

	<div class="col-sm-4">
		<div class="box box-warning">
			<div class="box-header">
				<i class="fa fa-list"></i>
				<h3 class="box-title">Rekomendasi</h3>
			</div>
			<div class="box-body">
				@foreach($recommends as $recommend)
					<a href="{{ url('/alumni/informasi/'.$recommend->information->id) }}"><p>{{ $recommend->information->title }}</p></a>
				@endforeach
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')    
	@include('layouts.partials.scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#table_id').DataTable({	    		
			"oLanguage":{
				"sZeroRecords": "Tidak ada data yang cocok.",
				"sEmptyTable": "Data kosong",
				"sSearch": "Cari",
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
	</script>
@stop