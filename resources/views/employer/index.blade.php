@extends('layouts.app')

@section('htmlheader_title', 'Keterserapan Tenaga Kerja')

@section('contentheader_description', 'Manajemen Keterserapan Tenaga Kerja di Industri')	

@section('contentheader_title', 'Keterserapan Tenaga Kerja')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/tableexport.min.css') }}" />
@stop

@section('main-content')
<div class="box box-warning">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">Keterserapan Tenaga Kerja</h3>		
		<div class="box-tools pull-right hidden-xs hidden-sm">
			{!! Form::open(['url' => '/admin/tenaga-kerja/', 'class' => 'form-inline', 'method' => 'GET']) !!}
				<select class="form-control" name="month">
				<option selected disabled>Bulan</option>
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>
			&emsp;
			<?php $current_year = \Carbon\Carbon::now()->year; ?>
			<select class="form-control" name="year">
				<option selected disabled>Tahun</option>
				@for($i = 2011; $i <= $current_year; $i++)
				<option value="{{ $i }}">{{ $i }}</option>
				@endfor
			</select>
			&emsp;
			<button type="submit" class="btn btn-primary btn-flat">Tampilkan</button>
			{!! Form::close() !!}
		</div>
		<div class="visible-xs visible-sm"><br>
			{!! Form::open(['url' => '/admin/tenaga-kerja/', 'class' => 'form-inline', 'method' => 'GET']) !!}
				<select class="form-control" name="month">
				<option selected disabled>Bulan</option>
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>
			&emsp;
			<?php $current_year = \Carbon\Carbon::now()->year; ?>
			<select class="form-control" name="year">
				<option selected disabled>Tahun</option>
				@for($i = 2011; $i <= $current_year; $i++)
				<option value="{{ $i }}">{{ $i }}</option>
				@endfor
			</select>
			&emsp;
			<button type="submit" class="form-control btn btn-primary btn-flat">Tampilkan</button>
			{!! Form::close() !!}
		</div>
	</div>	

	<div class="box-body">
		<a href="#" class="btn btn-success btn-flat" onClick="$('#table_id').tableExport({type: 'excel',escape: 'false'});">Download data <i class="fa fa-file-excel-o"></i></a><br><br>
		<div class="table-responsive">
		<table id="table_id" class="table table-striped table-bordered" cellspacing="0">
			<thead>			
				<tr>
					<th>Nama Siswa/Alumni</th>
					<th>Email</th>
					<th>Telepon</th>
					<th>Status</th>
					<th>Tanggal terima</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td><a href="{{ url('/admin/cv/'.$user->id) }}" target="_blank">{{ $user->name }}</a></td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->status }}</td>
					<td>{{ date('d F Y', strtotime($user->accepted)) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>
@stop

@section('scripts')    
	@include('layouts.partials.scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	{{-- <script type="text/javascript" src="{{ asset('/js/xlsx.core.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/Blob.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/FileSaver.js') }}"></script> --}}
	<script type="text/javascript" src="{{ asset('/js/tableExport.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/jquery.base64.js') }}"></script>	
	<script type="text/javascript">
		$('#table_id').DataTable({	    		
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
	</script>
@stop