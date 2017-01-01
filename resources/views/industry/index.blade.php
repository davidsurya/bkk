@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Industri')

@section('contentheader_title', 'Manajemen Industri')

@section('contentheader_description', 'Mengatur data industri')

@section('customheader')	
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
@stop

@section('main-content')
<div class="box box-warning">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">Daftar Industri</h3>
		<div class="box-tools pull-right">
			<button id="tambahindustri" class="btn btn-info btn-flat">Tambah Industri
			<i class="fa fa-plus"></i>
			</button>
		</div>
	</div>

	<div class="box-body">
		<table id="table_id" class="table table-striped table-bordered" cellspacing="0">
			<thead>
				<tr>			
					<th>No</th>
					<th>Nama Industri</th>
					<th>Email</th>
					<th>Telepon</th>
					<th>Alamat</th>					
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($industries as $industry)
				<tr>			
					<td>{{ $no++ }}</td>
					<td>{{ $industry->name }}</td>
					<td>{{ $industry->email }}</td>
					<td>{{ $industry->phone }}</td>
					<td>{{ $industry->address }}</td>							
					<td>
						<span title="Ubah"><a href="#" class="btn btn-success edit"
							data-id="{{ $industry->id }}"
							data-name="{{ $industry->name }}"
							data-email="{{ $industry->email }}"
							data-epublished="{{ $industry->email_published }}"
							data-phone="{{ $industry->phone }}"
							data-ppublished="{{ $industry->phone_published }}"
							data-website="{{ $industry->website }}"
							data-address="{{ $industry->address }}"
							data-lat="{{ $industry->lat }}"
							data-lng="{{ $industry->lng }}">
							<i class="glyphicon glyphicon-edit"></i></a>
						</span>				
						<span title="Hapus"><a href="#" class="btn btn-danger hapus"
							data-id="{{ $industry->id }}"
							data-name="{{ $industry->name }}">
							<i class="glyphicon glyphicon-trash"></i></a>
						</span>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div id="tambah" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Industri</span></h4>
			</div>
			<div class="register-box-body">
				<div class="modal-body">
					<p>Isi form perusahaan di bawah ini sesuai dengan industri terkait.</p>
					{!! Form::open(['class' => 'frm', 'method' => 'POST']) !!}
						@include('industry.partials.form')
				</div>
				<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>	
</div>

<div id="editindustri" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Industri</span></h4>
			</div>
			<div class="register-box-body">
				<div class="modal-body">
					<p>Isi form perusahaan di bawah ini sesuai dengan industri terkait.</p>
					{!! Form::open(['class' => 'frm', 'method' => 'PUT']) !!}
						@include('industry.partials.form')
				</div>
				<div class="modal-footer">
						<button type="submit" class="btn btn-success btn-flat">Update</button>
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>	
</div>

<div id="hapusindustri" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Data Industri</h4>
			</div>			
			<div class="modal-body">
				<p>Hapus data industri <span class="nama"><b></b></span> ??</p>
			</div>
			<div class="modal-footer">
				{!! Form::open(['class' => 'frm', 'method' => 'DELETE']) !!}
					{!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-flat']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')    
	@include('layouts.partials.scripts')
	<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
	    $(document).ready(function(){
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

	    	$('#table_id').DataTable({	    		
	    		"oLanguage":{
	    			"sZeroRecords": "Tidak ada data yang cocok.",
	    			"sEmptyTable": "Data kosong, silahkan tambah data terlebih dahulu.",
	    			"sSearch": "Cari Industri",
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

	    	$('#tambahindustri').click(function(){
	    		$('#tambah').modal('show');
	    		$('.name').val(null);
	    		$('.email').val(null);
	    		$('.email_published').removeAttr('checked');
	    		$('.phone').val(null);
	    		$('.phone_published').removeAttr('checked');
	    		$('.website').val(null);
	    		$('.address').val(null);
	    		$('.lat').val(null);
	    		$('.lng').val(null);
	    		$('.frm').attr('action', '{{ url('/admin/industri') }}');
	    	});	    

	    	$('.edit').click(function(){
	    		$('#editindustri').modal('show');
	    		$('.name').val($(this).data('name'));
	    		$('.email').val($(this).data('email'));
	    		$('.phone').val($(this).data('phone'));
	    		$('.website').val($(this).data('website'));
	    		$('.address').val($(this).data('address'));
	    		$('.lat').val($(this).data('lat'));
	    		$('.lng').val($(this).data('lng'));
	    		if($(this).data('epublished') == 1) {
	    			$('.email_published').attr('checked', '');	    			
	    		}else{
	    			$('.email_published').removeAttr('checked');
	    		}
	    		if($(this).data('ppublished') == 1) {
	    			$('.phone_published').attr('checked', '');
	    		}else{
	    			$('.phone_published').removeAttr('checked');
	    		}
	    		$('.frm').attr('action', '{{ url('/admin/industri/') }}/'+$(this).data('id'));
	    	});

	    	$('.hapus').click(function(){
	    		$('#hapusindustri').modal('show');
	    		$('.nama b').html($(this).data('name'));
	    		$('.frm').attr('action', '{{ url('/admin/industri/') }}/'+$(this).data('id'));
	    	});

	    	$('.email_published').click(function(){	    		
	    		if(!$(this).isChecked()) {
	    			$('.email_published').attr('checked', '');	    			
	    		}else{
	    			$('.email_published').removeAttr('checked');
	    		}
	    	});

	    	$('.phone_published').click(function(){
	    		if(!$(this).isChecked()) {
	    			$('.phone_published').attr('checked', '');
	    		}else{
	    			$('.phone_published').removeAttr('checked');
	    		}
	    	});	    				
	    });
    </script>    
@stop