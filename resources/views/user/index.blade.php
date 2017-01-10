@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Alumni')

@section('contentheader_title', 'Manajemen Alumni')

@section('contentheader_description', 'Alumni yang terdaftar dalam sistem')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
@stop

@section('main-content')
<div class="box box-warning">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">Daftar Alumni</h3>
		<div class="box-tools pull-right">
			<a href="{{ url('/admin/tambahalumni') }}" class="btn btn-info btn-flat">Tambah Alumni
			<i class="fa fa-plus"></i></a>
		</div>
	</div>

	<div class="box-body">
	<div class="table-responsive">			
		<table id="table_id" class="table table-striped table-bordered" cellspacing="0">
			<thead>
				<tr>			
					<th>Username</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Telepon</th>
					<th>Angkatan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>			
					<td>{{ $user->username }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone }}</td>			
					<td>{{ $user->graduation }}</td>
					<td>
						<span title="Lihat CV"><a href="{{ url('/admin/cv/'.$user->id) }}" class="btn btn-warning">
							<i class="glyphicon glyphicon-user"></i></a>
						</span>
						<span title="Ubah"><a href="#" class="btn btn-success edit"
							data-id="{{ $user->id }}"
							data-username="{{ $user->username }}"
							data-name="{{ $user->name }}"
							data-email="{{ $user->email }}"
							data-phone="{{ $user->phone }}"
							data-birthday="{{ $user->birthday }}"
							data-sex="{{ $user->sex }}"
							data-graduation="{{ $user->graduation }}"
							data-address="{{ $user->address }}"
							data-role="{{ $user->role->id }}"							
							data-study="{{ $user->department->name }}">
							<i class="glyphicon glyphicon-edit"></i></a>
						</span>
						<span title="Reset Password"><a href="#" class="btn btn-info reset"
							data-id="{{ $user->id }}"
							data-name="{{ $user->name }}">
							<i class="glyphicon glyphicon-refresh"></i></a>
						</span>
						<span title="Hapus"><a href="#" class="btn btn-danger hapus"
							data-id="{{ $user->id }}"
							data-name="{{ $user->name }}">
							<i class="glyphicon glyphicon-trash"></i></a>
						</span>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>

<div id="editalumni" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Data Alumni</h4>
			</div>
			<div class="register-box-body">
				<div class="modal-body">
					{!! Form::open(['class' => 'frm', 'method' => 'PUT']) !!}
						@include('user.partials.form')						
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-flat">Update <i class="fa fa-save"></i></button>
					{!! Form::close() !!}
				</div>					
			</div>
		</div>		
	</div>	
</div>

<div id="resetalumni" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Reset Password Alumni</h4>
			</div>			
			<div class="modal-body">
				<p>Setelah mereset password, password akan sama dengan <b>username</b> alumni yang bersangkutan. Reset password <span class="nama"><b></b></span> ??</p>
			</div>
			<div class="modal-footer">
				{!! Form::open(['class' => 'frm', 'method' => 'PUT']) !!}
					<button type="submit" class="btn btn-danger btn-flat">Reset <i class="fa fa-refresh"></i></button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<div id="hapusalumni" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Data Alumni</h4>
			</div>			
			<div class="modal-body">
				<p>Hapus data alumni dengan nama <span class="nama"><b></b></span> ??</p>
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
<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.l10n.id.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table_id').DataTable({
			"oLanguage":{
				"sZeroRecords": "Tidak ada data yang cocok.",
				"sEmptyTable": "Data kosong, silahkan tambah data terlebih dahulu.",
				"sSearch": "Cari alumni",
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

		$('#table_id').on('click', '.edit', function(){
			$('#editalumni').modal('show');
			$('#username').val($(this).data('username'));
			$('#name').val($(this).data('name'));
			$('#email').val($(this).data('email'));
			$('#phone').val($(this).data('phone'));
			$('#birthday').val($(this).data('birthday'));
			$('#sex').val($(this).data('sex'));
			$('#graduation').val($(this).data('graduation'));
			$('#address').val($(this).data('address'));
			$('#role').val($(this).data('role'));
			$('#study').val($(this).data('study'));
			$('#graduation option:first').attr('disabled', true);
			$('.frm').attr('action','{{ url('/admin/alumni') }}/'+$(this).data('id'));
		});

		$('#table_id').on('click', '.reset', function(){
			$('#resetalumni').modal('show');
			$('.nama b').html($(this).data('name'));
			$('.frm').attr('action','{{ url('/admin/alumni-reset') }}/'+$(this).data('id'));
		});

		$('#table_id').on('click', '.hapus', function(){
			$('#hapusalumni').modal('show');
			$('.nama b').html($(this).data('name'));
			$('.frm').attr('action', '{{ url('/admin/alumni') }}/'+$(this).data('id'));
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

		$(".flatpickr-input").flatpickr({
            allowInput: true            
    	});
    	$(".flatpickr-input").removeAttr("readonly");
	});
</script>
@stop