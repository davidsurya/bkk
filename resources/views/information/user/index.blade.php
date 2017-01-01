@extends('layouts.app')

@section('htmlheader_title', 'Informasi Lowongan')

@section('contentheader_title', 'Informasi Lowongan')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
@stop

@section('main-content')
<br>
<div class="row">
	<div class="col-sm-8">
		@foreach($informations as $information)
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-list"></i>
				<h3 class="box-title">{{ $information->title }}</h3>
				<p><i>{{ $information->created_at }}</i> oleh <i>{{ $information->user->name }}</i></p>
				<div class="box-tools pull-right">
					<a href="{{ url('/alumni/download-pdf/'.$information->id) }}">
					<button class="btn btn-danger btn-flat hidden-xs hidden-sm">Download PDF <i class="fa fa-file-pdf-o"></i></button></a>
				</div>
				<a href="{{ url('/alumni/download-pdf/'.$information->id) }}"><button class="btn btn-danger btn-flat visible-xs visible-sm">Download PDF <i class="fa fa-file-pdf-o"></i></button></a>
			</div>
			
			<div class="box-body">		
				<p>{{ str_limit($information->definition, 250) }}</p>
				<p><a href="{{ url('/alumni/informasi/'.$information->id) }}">Selengkapnya</a></p>
			</div>
		</div>
		@endforeach	
		<center>{{ $informations->links() }}</center>
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
	<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>
	<script>		
		@if(Auth::user()->location == null || Auth::user()->skill == null || Auth::user()->address == null)
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": 0,
				"extendedTimeOut": 0,
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut",
				"tapToDismiss": false
			}

			toastr.warning('Selamat datang di Sistem Informasi Bursa Kerja Khusus. Silahkan update informasi Anda.<br><br><a href="{{ url('/alumni/profil') }}" class="btn btn-success btn-flat pull-right">OK, update informasi</a>');			
		@endif
	</script>
@stop