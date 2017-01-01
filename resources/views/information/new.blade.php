@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Informasi')

@section('contentheader_description', 'Mengatur isi informasi yang ditampilkan')	

@section('contentheader_title', 'Manajemen Informasi')

@section('customheader')	
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
@stop

@section('main-content')
<div class="box-tools pull-left">
	<a href="{{ url('/admin/tambah-informasi/') }}">
	<button id="tambahinfo" class="btn btn-info btn-flat">Tambah Informasi
		<i class="fa fa-plus"></i>
	</button>
	</a>
</div>
<br><br>
@foreach($infos as $info)
<div class="box box-warning">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">{{ $info->title }}</h3>
		<div class="box-tools pull-right hidden-xs">
			<a href="{{ url('/admin/pelamar/'.$info->id) }}" class="btn btn-warning btn-flat" title="Lihat pelamar"><i class=" fa fa-user"></i></a>
			@if($info->hidden == 1)
			<a href="{{ url('/admin/informasi-tampil/'.$info->id) }}" class="btn btn-info btn-flat" title="Tampilkan"><i class=" fa fa-eye-slash"></i></a>
			@else
			<a href="{{ url('/admin/informasi-sembunyi/'.$info->id) }}" class="btn btn-info btn-flat" title="Sembunyikan"><i class=" fa fa-eye"></i></a>
			@endif
			<a href="{{ url('/admin/edit-informasi/'.$info->id) }}" class="btn btn-success btn-flat" title="Update"><i class=" fa fa-edit"></i></a>
			<a href="#" class="btn btn-danger btn-flat hapus" title="Hapus"
			data-id="{{ $info->id }}" data-title="{{ $info->title }}"><i class=" fa fa-trash"></i></a>
		</div>
		<p><i>{{ $info->created_at }}</i> oleh <i>{{ $info->user->name }}</i></p>
		<div class="visible-xs">
			<a href="{{ url('/admin/pelamar/'.$info->id) }}" class="btn btn-warning btn-flat"><i class=" fa fa-user">
			</i></a>
			@if($info->hidden == 1)
			<a href="{{ url('/admin/informasi-tampil/'.$info->id) }}" class="btn btn-info btn-flat"><i class=" fa fa-eye-slash"></i></a>
			@else
			<a href="{{ url('/admin/informasi-sembunyi/'.$info->id) }}" class="btn btn-info btn-flat"><i class=" fa fa-eye"></i></a>
			@endif
			<a href="{{ url('/admin/edit-informasi/'.$info->id) }}" class="btn btn-success btn-flat"><i class=" fa fa-edit"></i></a>
			<a href="#" class="btn btn-danger btn-flat hapus" data-id="{{ $info->id }}" data-title="{{ $info->title }}"><i class=" fa fa-trash"></i></a>
		</div>
	</div>

	<div class="box-body">		
		<p>{{ str_limit($info->definition, 250) }}</p>
		<p><a href="{{ url('/admin/informasi/'.$info->id) }}">Selengkapnya</a></p>
	</div>
</div>
@endforeach

<center>{{ $infos->links() }}</center>

<div id="hapusinformasi" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Data Informasi</h4>
			</div>			
			<div class="modal-body">
				<p>Hapus informasi dengan judul <span id="nama"><b></b></span> ??</p>
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
<script type="text/javascript">
	$(document).ready(function(){

		$('.hapus').click(function(){
			$('#hapusinformasi').modal('show');
			$('#nama b').html($(this).data('title'));
			$('.frm').attr('action', '{{ url('/admin/informasi') }}/'+$(this).data('id'));
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
	});
</script>
@stop